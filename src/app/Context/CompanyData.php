<?php

declare(strict_types=1);

namespace App\Context;

class CompanyData
{
    public function __construct(
        public readonly string $name,
        public readonly string $edrpou,
        public readonly string $address,
    ){}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'address' => $this->address,
        ];
    }
}
