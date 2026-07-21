<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * MeterSortProperty
 */
enum MeterSortProperty: string
{
    case CREATED_AT = 'created_at';
    case CREATED_AT_2 = '-created_at';
    case NAME = 'name';
    case NAME_2 = '-name';
}