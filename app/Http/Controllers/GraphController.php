<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Http\Resources\DayChartResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GraphController extends Controller
{
    public function index(string $country)
    {
        $days = Day::query()
            ->where('confirmed', '>', 0)
            ->whereCountry($country)
            ->orderBy('date', 'asc')
            ->get();

        if($days->count() === 0) {
            throw new ModelNotFoundException();
        }

        $chartData = DayChartResource::make($days);

        return view('graph', [
            'days' => $days,
            'chartData' => $chartData,
            'country' => $days->first()->country,
        ]);
    }
}
