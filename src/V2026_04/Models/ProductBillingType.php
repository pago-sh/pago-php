<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * ProductBillingType
 */
enum ProductBillingType: string
{
    case ONE_TIME = 'one_time';
    case RECURRING = 'recurring';
}