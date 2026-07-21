<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * MetricType
 */
enum MetricType: string
{
    case SCALAR = 'scalar';
    case CURRENCY = 'currency';
    case CURRENCY_SUB_CENT = 'currency_sub_cent';
    case PERCENTAGE = 'percentage';
}