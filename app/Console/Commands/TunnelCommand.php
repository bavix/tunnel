<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Tunnel;
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
    public function handle(): void
    {
        /**
         * @var Tunnel $tunnel
         */
        foreach (Tunnel::query()->where('enabled', 1)->get() as $tunnel) {
            app(TunnelService::class)->init($tunnel);
        }
    }
}
