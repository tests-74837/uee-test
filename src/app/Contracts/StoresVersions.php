<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface StoresVersions
{
    public function newQuery();

    public function instance(): BelongsTo;

    public function fill(array $attributes);

    public function save(array $options = []);

    public function setVersion(int $version): void;

    public function getVersion(int $version): int;
}
