<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * FilterOperator
 */
enum FilterOperator: string
{
    case EQ = 'eq';
    case NE = 'ne';
    case GT = 'gt';
    case GTE = 'gte';
    case LT = 'lt';
    case LTE = 'lte';
    case LIKE = 'like';
    case NOT_LIKE = 'not_like';
}