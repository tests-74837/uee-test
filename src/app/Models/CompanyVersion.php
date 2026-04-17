<?php

declare(strict_types=1);

namespace App\Models;

use App\Contracts\StoresVersions;
use App\Models\Traits\InteractsWithVersioned;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $instance_id
 * @property int $version
 * @property string $name
 * @property string $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company $instance
 * @method static \Database\Factories\CompanyVersionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyVersion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyVersion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyVersion query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyVersion whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyVersion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyVersion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyVersion whereInstanceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyVersion whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyVersion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyVersion whereVersion($value)
 * @mixin \Eloquent
 */
class CompanyVersion extends Model implements StoresVersions
{
    /** @use HasFactory<\Database\Factories\CompanyVersionFactory> */
    use HasFactory;
    use InteractsWithVersioned;

    public $fillable = [
        'name',
        'address',
        'edrpou',
    ];

    public function getVersionedModelClass(): string
    {
        return Company::class;
    }

    public function setVersion(int $version): void
    {
        $this->version = $version;
    }

    public function getVersion(int $version): int
    {
        return $this->version;
    }
}
