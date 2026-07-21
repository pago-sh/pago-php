<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * Status
 */
enum Status: string
{
    case ACTIVE = 'active';
    case TRIALING = 'trialing';
}