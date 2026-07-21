<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * TaxBehaviorOption
 */
enum TaxBehaviorOption: string
{
    case LOCATION = 'location';
    case INCLUSIVE = 'inclusive';
    case EXCLUSIVE = 'exclusive';
}