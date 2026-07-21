<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * MeterUnit
 */
enum MeterUnit: string
{
    case SCALAR = 'scalar';
    case TOKEN = 'token';
    case CUSTOM = 'custom';
}