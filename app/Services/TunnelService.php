<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Tunnel;

class TunnelService
{
    /**
     * @param Tunnel $tunnel
     */
    public function init(Tunnel $tunnel): void
    {
        $local = escapeshellcmd("{$tunnel->where_to}:localhost:{$tunnel->where_from}");
        $address = escapeshellcmd($tunnel->address);

        $option = ' -L ';
        if ($tunnel->reverse) {
            $option = ' -R ';
        }

        @exec('autossh -M ' . (20000 + $tunnel->getKey()) . ' -f -N ' . $address . $option . $local . ' -C', $output);
    }
}
