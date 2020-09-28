<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;

final class Entry
{
    public Country $country;

    public int $confirmed;

    public int $deaths;

    public int $recovered;

    public Carbon $date;

    public function __construct(Country $country, array $info)
    {
        $this->country   = $country;
        $this->confirmed = $info['Confirmed'];
        $this->deaths    = $info['Deaths'];
        $this->recovered = $info['Recovered'];
        $this->date      = Carbon::createFromFormat('Y-m-d\TH:i:s\Z', $info['Date'])->startOfDay();
    }
}
