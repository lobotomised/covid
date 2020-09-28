<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $guarded = [];

    protected $casts = [
        'date'      => 'datetime',
        'confirmed' => 'integer',
        'deaths'    => 'integer',
        'recovered' => 'integer',
    ];

    protected $attributes = [
        'confirmed' => 0,
        'deaths'    => 0,
        'recovered' => 0,
    ];

    public function scopeWhereCountry(Builder $builder, string $country): Builder
    {
        $builder->where('country', $country);

        return $builder;
    }

    public function getOngoingAttribute(): int
    {
        return ($this->confirmed ?? 0) - (($this->deaths ?? 0) + ($this->recovered ?? 0));
    }

    public static function getCountries(): Collection
    {
        return self::query()
            ->select('country')
            ->groupBy('country')
            ->get();
    }
}
