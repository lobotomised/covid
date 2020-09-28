<?php

declare(strict_types=1);

namespace App\Support;

class GitVersion
{
    private static function getFilePath(): string
    {
        return base_path() . '/commit_sha';
    }

    public static function getSha1(): ?string
    {
        if (file_exists(self::getFilePath())) {
            return trim(file_get_contents(self::getFilePath()));
        }

        return null;
    }
}
