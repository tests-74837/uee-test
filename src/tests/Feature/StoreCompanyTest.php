<?php

declare(strict_types=1);

it('can store a new company', function () {
    $response = $this->post(route('v1.companies.store'), [
        'name' => 'Test Company',
        'address' => '123 Test Street',
        'edrpou' => '12345678',
    ]);

    $response->assertSuccessful();

    $response->assertJsonPath('status', 'created');
    $response->assertJsonPath('version', 1);

    $this->assertDatabaseHas('companies', [
        'name' => 'Test Company',
        'address' => '123 Test Street',
        'edrpou' => '12345678',
    ]);
});

it('can update an existing company', function () {
    $company = \App\Models\Company::factory()->create();
    $version = \App\Models\CompanyVersion::factory()
        ->forCompany($company)
        ->create();

    $response = $this->post(route('v1.companies.store'), [
        'name' => 'Updated Company',
        'address' => '456 Updated Street',
        'edrpou' => $company->edrpou,
    ]);

    $response->assertSuccessful();

    $response->assertJsonPath('status', 'updated');
    $response->assertJsonPath('version', 2);

    $this->assertDatabaseHas('companies', [
        'id' => $company->id,
        'name' => 'Updated Company',
        'address' => '456 Updated Street',
        'edrpou' => $company->edrpou,
    ]);
});

it('does not save duplicate company', function () {
    $company = \App\Models\Company::factory()->create();
    $version = \App\Models\CompanyVersion::factory()
        ->forCompany($company)
        ->create();

    $response = $this->post(route('v1.companies.store'), [
        'name' => $company->name,
        'address' => $company->address,
        'edrpou' => $company->edrpou,
    ]);

    $response->assertSuccessful();

    $response->assertJsonPath('status', 'duplicate');
    $response->assertJsonPath('version', 1);

    $this->assertDatabaseHas('companies', [
        'id' => $company->id,
        'name' => $company->name,
        'address' => $company->address,
        'edrpou' => $company->edrpou,
    ]);
});
