<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Label;
use App\Services\IpService;
use Illuminate\Console\Command;
use Iodev\Whois\Factory;
use Iodev\Whois\Whois;

class OpenVpnExportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'openvpn:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Returns a list of routes for openvpn';

    private Whois $whois;
    private IpService $ipService;

    public function __construct(Factory $factory, IpService $ipService)
    {
        parent::__construct();
        $this->whois = $factory->createWhois();
        $this->ipService = $ipService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
        /** @var Label $label */
        foreach (Label::whereEnabled(true)->with(['asns', 'ipAddresses'])->cursor() as $label) {
            echo '# ', $label->name, PHP_EOL;
            $ipAddresses = [];
            foreach ($label->asns as $asn) {
                if (!$asn->enabled) {
                    continue;
                }

                $asnInfo = $this->whois->loadAsnInfo($asn->value);
                if ($asnInfo === null) {
                    continue;
                }

                foreach ($asnInfo->routes as $route) {
                    if ($route->route === '') {
                        continue;
                    }

                    $address = current(explode('/', $route->route));
                    $subnet = $this->ipService->subnet($route->route);
                    $ipAddresses[] = [$address, $subnet];
                }
            }

            foreach ($label->ipAddresses as $ipAddress) {
                if (!$ipAddress->enabled) {
                    continue;
                }

                $ipAddresses[] = [$ipAddress->address, $ipAddress->subnet];
            }

            foreach ($ipAddresses as [$address, $subnet]) {
                echo sprintf('push "route %s %s"', $address, $subnet), PHP_EOL;
            }

            echo PHP_EOL;
        }
    }
}
