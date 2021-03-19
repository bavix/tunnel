<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Label;
use Illuminate\Console\Command;

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

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
        /** @var Label $label */
        foreach (Label::with('ipAddresses')->cursor() as $label) {
            echo '# ', $label->name, PHP_EOL;
            foreach ($label->ipAddresses as $ipAddress) {
                echo sprintf('push "route %s %s"', $ipAddress->address, $ipAddress->subnet), PHP_EOL;
            }

            echo PHP_EOL;
        }
    }
}
