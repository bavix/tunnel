<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Label;
use Exception;
use Illuminate\Console\Command;

class OpenVpnStubCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'openvpn:stub {file} {name}';

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
     *
     * @throws Exception
     */
    public function handle(): void
    {
        $input = file_get_contents($this->argument('file'));
        $name = $this->argument('name');

        ob_start();
        app(OpenVpnExportCommand::class)->handle();
        $export = trim(ob_get_clean());

        echo str_replace($name, $export, $input);
    }
}
