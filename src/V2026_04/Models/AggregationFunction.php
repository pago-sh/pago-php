<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * AggregationFunction
 */
enum AggregationFunction: string
{
    case COUNT = 'count';
    case SUM = 'sum';
    case MAX = 'max';
    case MIN = 'min';
    case AVG = 'avg';
    case UNIQUE = 'unique';
}