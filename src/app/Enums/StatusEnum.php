<?php

declare(strict_types=1);

namespace App\Enums;

enum StatusEnum: string
{
    case UPDATED = 'updated';
    case CREATED = 'created';
    case DUPLICATE = 'duplicate';
}
