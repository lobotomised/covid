<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Mail\UpdateMail;
use App\Models\Day;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;

class NotifyCommand extends Command
{
    protected $signature = 'sync:notify';

    public function handle(): void
    {
        if (config('app.email') === null) {
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
