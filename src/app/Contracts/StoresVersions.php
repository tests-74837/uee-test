<?php

declare(strict_types=1);

namespace App\Contracts;

interface StoresVersions
{
    public function newQuery();

    public function fill(array $attributes);

    public function save(array $options = []);

    public function setVersion(int $version): void;

    public function getVersion(int $version): int;
}
