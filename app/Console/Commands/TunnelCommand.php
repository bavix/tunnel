<?php

namespace App\Console\Commands;

use App\Tunnel;
use Illuminate\Console\Command;
use App\Services\TunnelService;

class TunnelCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tunnel:service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks and starts the tunnel';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /**
         * @var Tunnel $tunnel
         */
        foreach (Tunnel::all() as $tunnel) {
            app(TunnelService::class)->init($tunnel);
        }
    }

}
