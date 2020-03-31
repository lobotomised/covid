<?php

namespace App\Http\Controllers;

use App\Models\Day;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $countries = Day::query()
            ->select('country')
            ->groupBy('country')
            ->get();

        return view ('index', compact('countries'));
    }
}
