<?php

declare(strict_types=1);

namespace App\Models\Traits;

use App\Contracts\StoresVersions;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait InteractsWithVersions
{
    private abstract function isDirty($attributes = null);

    private abstract function getAttributes();

    private abstract function getVersionModelClass(): string;

    public function versions(): HasMany
    {
        $versionModelClass = $this->getVersionModelClass();

        if (false === is_subclass_of($versionModelClass, StoresVersions::class)) {
            throw new \RuntimeException('Version model must implement StoresVersions interface');
        }

        return $this->hasMany($versionModelClass, 'instance_id', 'id');
    }

    public function currentVersion(): HasOne
    {
        $versionModelClass = $this->getVersionModelClass();

        if (false === is_subclass_of($versionModelClass, StoresVersions::class)) {
            throw new \RuntimeException('Version model must implement StoresVersions interface');
        }

        return $this->hasOne($versionModelClass, 'instance_id', 'id')->orderBy('version', 'desc')->limit(1);
    }

    public function saveModelAndVersion(array $options = [])
    {
        $versionModelClass = $this->getVersionModelClass();
        $versionModel = new $versionModelClass();

        if (false === $versionModel instanceof StoresVersions) {
            throw new \RuntimeException('Version model must implement StoresVersions interface');
        }

        $currentVersion = $versionModel->newQuery()
            ->where('instance_id', $this->getKey())
            ->orderBy('version', 'desc')->first();

        if ($this->isDirty() === false) {
            return false;
        }

        $result = parent::save($options);

        $versionModel->setVersion($currentVersion ? $currentVersion->version + 1 : 1);
        $versionModel->instance()->associate($this);
        $versionModel->fill($this->getAttributes());
        $versionModel->save();

        $this->setRelation('currentVersion', $versionModel);

        return $result;
    }
}
