<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\DayChartResource;
use App\Http\Resources\DayTableResource;
use App\Models\Day;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class GraphController extends Controller
{
    public function index(string $country)
    {
        /** @var Collection|Day[] $days */
        $days = Day::query()
            ->whereCountry($country)
            ->orderBy('date', 'asc')
            ->get();

        if ($days->count() === 0) {
            throw new ModelNotFoundException();
        }

        return view('graph', [
            'days'      => $days,
            'chartData' => DayChartResource::make($days),
            'tableData' => DayTableResource::make($days),
            'country'   => $days->first()->country,
        ]);
    }
}
