<?php

declare(strict_types=1);

it('can index company versions', function () {
    $company = \App\Models\Company::factory()->create();
    $version1 = \App\Models\CompanyVersion::factory()
        ->forCompany($company)
        ->version(1)
        ->create([
            'name' => fake()->company,
            'address' => fake()->address,
        ]);

    $version2 = \App\Models\CompanyVersion::factory()
        ->forCompany($company)
        ->version(2)
        ->create();

    $response = $this->get(route('v1.companies.versions.index', ['edrpou' => $company->edrpou]));

    $response->assertSuccessful();

    $response->assertJsonCount(2, 'data');
    $response->assertJsonPath('data.0.version', $version1->version);
    $response->assertJsonPath('data.0.name', $version1->name);
    $response->assertJsonPath('data.1.version', $version2->version);
    $response->assertJsonPath('data.1.name', $version2->name);
});
