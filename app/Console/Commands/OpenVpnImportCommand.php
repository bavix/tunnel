<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\IpAddress;
use App\Models\Label;
use Illuminate\Console\Command;
use JetBrains\PhpStorm\Pure;

class OpenVpnImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'openvpn:import {label} {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import new routes into openvpn';

    /**
     * @param string $mask
     *
     * @return int
     */
    #[Pure]
    private function cidr(string $mask): int
    {
        $long = ip2long($mask);
        $base = ip2long('255.255.255.255');

        return (int) (32-log(($long ^ $base)+1,2));
    }

    /**
     * @param string $line
     *
     * @return array
     */
    private function getIpAndNetmaskByString(string $line): array
    {
        if (str_contains($line, '/')) {
            [$ip, $cidr] = explode('/', $line, 2);
        } else {
            [$ip, $subnet] = explode(' ', $line, 2);
            $cidr = $this->cidr($subnet);
        }

        return [$ip, (int) $cidr];
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
        /** @var Label $label */
        $label = Label::firstOrCreate(['name' => $this->argument('label')]);
        $handle = fopen($this->argument('file'), 'rb');

        while ($line = fgets($handle, 4096)) {
            $line = trim($line);
            if ($line === '' || $line[0] === '#') {
                continue;
            }

            [$ip, $cidr] = $this->getIpAndNetmaskByString($line);

            IpAddress::firstOrCreate([
                'label_id' => $label->id,
                'address' => $ip,
                'netmask' => $cidr,
            ]);
        }
    }
}
