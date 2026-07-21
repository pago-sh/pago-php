<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * EventSortProperty
 */
enum EventSortProperty: string
{
    case TIMESTAMP = 'timestamp';
    case TIMESTAMP_2 = '-timestamp';
}