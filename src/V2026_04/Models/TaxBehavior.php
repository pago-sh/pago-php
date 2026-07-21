<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * TaxBehavior
 */
enum TaxBehavior: string
{
    case INCLUSIVE = 'inclusive';
    case EXCLUSIVE = 'exclusive';
}