<?php

namespace App\Console\Commands;

use App\Models\Day;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SyncDaysCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:days';

    public function handle()
    {
        $this->sync(
            'confirmed',
            json_decode(file_get_contents('https://coronavirus-tracker-api.herokuapp.com/confirmed'), true)
        );

        $this->sync(
            'deaths',
            json_decode(file_get_contents('https://coronavirus-tracker-api.herokuapp.com/deaths'), true)
        );

        $this->sync(
            'recovered',
            json_decode(file_get_contents('https://coronavirus-tracker-api.herokuapp.com/recovered'), true)
        );
    }

    private function sync(string $type, array $data)
    {
        $this->info("Syncing {$type}");

        $locationCount = count($data['locations']);

        $i = 0;

        foreach($data['locations'] as $item) {
            $country = $item['province'] ?: $item['country'];

            foreach($item['history'] as $date => $count) {
                $date = Carbon::createFromFormat('n/j/y', $date)->startOfDay();

                Day::updateOrCreate([
                    'country_code' => $item['country_code'],
                    'country' => $country,
                    'date' => $date
                ], [
                    $type => $count,
                ]);
            }

            $i += 1;

            $this->comment("✅ {$item['country_code']} {$country} ({$i}/{$locationCount})");
        }

    }
}
