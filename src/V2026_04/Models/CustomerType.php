<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * CustomerType
 */
enum CustomerType: string
{
    case INDIVIDUAL = 'individual';
    case TEAM = 'team';
}