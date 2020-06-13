<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Day;

class HomeController extends Controller
{
    public function index()
    {
        $countries = Day::query()
            ->select('country')
            ->groupBy('country')
            ->get();

        return view('index', compact('countries'));
    }
}
