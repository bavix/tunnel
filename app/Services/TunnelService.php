<?php

namespace App\Services;

use App\Tunnel;

class TunnelService
{

    /**
     * @param Tunnel $tunnel
     */
    public function init(Tunnel $tunnel): void
    {
        $local = escapeshellcmd("{$tunnel->where_to}:localhost:{$tunnel->where_from}");
        $address = escapeshellcmd($tunnel->address);
        @exec('autossh -M ' . (20000 + $tunnel->getKey()) . ' -f -N ' . $address . ' -R ' . $local . ' -C', $output);
    }

}
