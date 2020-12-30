<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Day;
use Illuminate\Http\Resources\Json\JsonResource;

class DayTableResource extends JsonResource
{
    /** @var \Illuminate\Support\Collection|\App\Models\Day[] */
    public $resource;

    public function toArray($request)
    {
        $rows = $this->resource->map(function (Day $day) {
            return [
                $day->date->format('Y'),
                $day->deaths ?? 0,
                $day->recovered ?? 0,
                $day->ongoing ?? 0,
            ];
        });

        return [...$rows];
    }
}
