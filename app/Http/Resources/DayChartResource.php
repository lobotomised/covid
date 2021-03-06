<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Day;
use Illuminate\Http\Resources\Json\JsonResource;

class DayChartResource extends JsonResource
{
    /** @var \Illuminate\Support\Collection|\App\Models\Day[] */
    public $resource;

    public function toArray($request)
    {
        $headers = ['Day (d/m/Y)', 'Morts', 'Rétablies'];

        $rows = $this->resource->map(function (Day $day) {
            return [
                $day->date->format('d/m/Y'),
                $day->deaths ?? 0,
                $day->recovered ?? 0,
            ];
        });

        return [ $headers, ...$rows ];
    }
}
