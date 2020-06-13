<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Http\Resources\DayChartResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class GraphController extends Controller
{
    public function index(string $country)
    {
        /** @var Collection|Day[] $days */
        $days = Day::query()
            ->where('confirmed', '>', 0)
            ->whereCountry($country)
            ->orderBy('date', 'asc')
            ->get();

        if($days->count() === 0) {
            throw new ModelNotFoundException();
        }

        $chartData = DayChartResource::make($days);

        $sum = [
            'confirmed' => $days->sum('confirmed'),
            'deaths' => $days->sum('deaths'),
            'recovered' => $days->sum('recovered'),
        ];

        return view('graph', [
            'days' => $days,
            'chartData' => $chartData,
            'sum' => $sum,
            'country' => $days->first()->country,
        ]);
    }
}
