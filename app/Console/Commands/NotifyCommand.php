<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Day;
use Illuminate\Support\Facades\Mail;
use App\Mail\UpdateMail;

class NotifyCommand extends Command
{

    protected $signature = 'sync:notify';

    public function handle()
    {
        if (config('app.email') === null ) {
            return ;
        }

        /** @var Collection|Day[] $records */
        $records = Day::whereCountry('France')
            ->orderByDesc('date')
            ->skip(0)
            ->take(2)
            ->get();

        Mail::to(config('app.email'))
            ->send(
                new UpdateMail($records->first(), $records->get(1))
            )
        ;
    }
}
