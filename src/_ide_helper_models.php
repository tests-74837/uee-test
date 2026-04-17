<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
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
 */
	class CompanyVersion extends \Eloquent implements \App\Contracts\StoresVersions {}
}

