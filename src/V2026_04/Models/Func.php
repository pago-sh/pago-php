<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * Func
 */
enum Func: string
{
    case SUM = 'sum';
    case MAX = 'max';
    case MIN = 'min';
    case AVG = 'avg';
}