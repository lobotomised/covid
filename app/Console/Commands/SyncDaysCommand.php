<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Day;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncDaysCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:days';

    public function handle(): void
    {
        try {
            $confirmed = file_get_contents('https://coronavirus-tracker-api.herokuapp.com/confirmed');
            $deaths    = file_get_contents('https://coronavirus-tracker-api.herokuapp.com/deaths');
            $recovered = file_get_contents('https://coronavirus-tracker-api.herokuapp.com/recovered');
        } catch (\Exception $e) {
            Log::debug('Error loading api');

            return;
        }

        $this->sync('confirmed', json_decode($confirmed, true));

        $this->sync('deaths', json_decode($deaths, true));

        $this->sync('recovered', json_decode($recovered, true));
    }

    private function sync(string $type, array $data): void
    {
        $this->info("Syncing {$type}");

        $locationCount = count($data['locations']);

        $i = 0;

        foreach ($data['locations'] as $item) {
            $country = $item['province'] ?: $item['country'];

            foreach ($item['history'] as $date => $count) {
                $date = Carbon::createFromFormat('n/j/y', $date)->startOfDay();

                Day::updateOrCreate([
                    'country_code' => $item['country_code'],
                    'country'      => $country,
                    'date'         => $date,
                ], [
                    $type => $count,
                ]);
            }

            $i += 1;

            $this->comment("✅ {$item['country_code']} {$country} ({$i}/{$locationCount})");
        }
    }
}
