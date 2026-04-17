<?php

declare(strict_types=1);

namespace App\Models\Traits;

use App\Models\Company;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait InteractsWithVersioned
{
    public abstract function getVersionedModelClass(): string;

    public function instance(): BelongsTo
    {
        return $this->belongsTo($this->getVersionedModelClass(), 'instance_id');
    }
}
