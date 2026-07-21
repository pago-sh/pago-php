<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * SubType
 */
enum SubType: string
{
    case USER = 'user';
    case ORGANIZATION = 'organization';
}