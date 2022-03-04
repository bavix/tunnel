<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Label;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class AsnCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asn:import {company}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Finds matches in the database and adds new asn addresses';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
        $company = $this->argument('company');

        /** @var Label $label */
        $label = Label::with(['asns'])
            ->where('name', 'like', '%' . $company . '%')
            ->firstOrFail();

        $asnList = $label
            ->asns
            ->pluck('value')
            ->toArray();

        $values = Http::get(sprintf('https://api.bgpview.io/search?query_term=%s', $company))
            ->json();

        $data = $values['data']['asns'] ?? [];
        foreach ($data as $datum) {
            $asnId = $datum['asn'] ?? null;
            if ($asnId === null) {
                continue;
            }

            if (in_array('AS' . $asnId, $asnList, true)) {
                echo 'Skip AS' . $asnId, PHP_EOL;
                continue;
            }

            echo 'Add new AS' . $asnId, PHP_EOL;

            $asnList[] = 'AS' . $asnId;
            $label->asns()->create(['value' => 'AS' . $asnId]);
        }
    }
}
