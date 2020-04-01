<?php

namespace App\Http\Controllers;

use App\Models\Day;
use Illuminate\Support\Facades\Response;

class SitemapController extends Controller
{
    private array $url;

    public function index(): \Illuminate\Http\Response
    {
        $this->url[] = config('app.url');

        $countries = Day::query()
            ->select('country')
            ->groupBy('country')
            ->get();


        foreach ($countries as $country) {
            $this->url[] = route('country', $country->country);
        }

        $view = view('sitemap', ['urls' => $this->url])->render();

        return Response::make($view, 200, [
            'content-type' => 'text/xml'
        ]);
    }
}
