<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Country;
use App\Models\Day;
use App\Models\Entry;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class SyncDaysCommand extends Command
{
    protected $signature = 'sync:days';

    public Collection $countries;

    public function handle(): void
    {
        $this->getCountries()
            ->each(function (Country $country, int $key) {

                $this->comment(
                    sprintf("✅ %s %s (%d/%d)",
                        $country->code,
                        $country->name,
                        ++$key,
                        $this->countries->count()
                    )
                );

                $this->getDataByCountry($country)
                    ->each(fn(Entry $entry) => $this->saveEntry($entry));
        });
    }

    /**
     * @return \Illuminate\Support\Collection|\App\Models\Country[]
     */
    private function getCountries(): Collection
    {
        $response = Http::get('https://api.covid19api.com/countries');

        $list = collect();

        if ($response->ok()) {
            foreach ($response->json() as $country) {
                $list->push(
                    new Country($country['Country'], $country['Slug'], $country['ISO2'])
                );
            }
        }

        $this->countries = $list;

        return $list;
    }

    /**
     * @param \App\Models\Country $country
     *
     * @return \Illuminate\Support\Collection|\App\Models\Entry[]
     */
    private function getDataByCountry(Country $country): Collection
    {
        $response = Http::get('https://api.covid19api.com/total/country/' . $country->slug);

        $entries = collect();

        if ($response->ok()) {
            foreach ($response->json() as $info) {
                $entries->push(
                    new Entry($country, $info)
                );
            }
        }

        return $entries;
    }

    private function saveEntry(Entry $entry): void
    {
        Day::updateOrCreate(
            [
                'country_code' => $entry->country->code,
                'country'      => $entry->country->name,
                'date'         => $entry->date,
            ],
            [
                'confirmed' => $entry->confirmed,
                'deaths'    => $entry->deaths,
                'recovered' => $entry->recovered,
            ]
        );
    }
}
