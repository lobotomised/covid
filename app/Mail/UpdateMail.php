<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\Day;
use App\Support\Number;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdateMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    private Day $today;

    private Day $yesterday;

    public function __construct(Day $today, Day $yesterday)
    {
        $this->today     = $today;
        $this->yesterday = $yesterday;
    }

    public function build()
    {
        return $this->text('email')
            ->subject('Covid-19: Mise à jour')
            ->with([
                'date'           => $this->today->date,
                'confirmed'      => $this->today->confirmed,
                'deaths'         => $this->today->deaths,
                'recovered'      => $this->today->recovered,
                'confirmedDelta' => Number::delta($this->today->confirmed, $this->yesterday->confirmed),
                'deathsDelta'    => Number::delta($this->today->deaths, $this->yesterday->deaths),
                'recoveredDelta' => Number::delta($this->today->recovered, $this->yesterday->recovered),
            ]);
    }
}
