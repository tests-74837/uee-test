<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\CompanyVersion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CompanyVersion>
 */
class CompanyVersionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'version' => 1
        ];
    }

    public function forCompany(Company $company): static
    {
        return $this->state(function (array $attributes) use ($company) {
            return [
                'instance_id' => $company->getKey(),
                'name' => $company->name,
                'address' => $company->address,
                'edrpou' => $company->edrpou,
            ];
        });
    }

    public function version(int $version): static
    {
        return $this->state(function (array $attributes) use ($version) {
            return [
                'version' => $version,
            ];
        });
    }
}
