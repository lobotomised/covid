<?php

declare(strict_types=1);

namespace App\Models;

final class Country
{
    public string $name;

    public string $slug;

    public string $code;

    public function __construct(string $name, string $slug, string $code)
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->code = $code;
    }
}
