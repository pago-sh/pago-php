<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * EventSource
 */
enum EventSource: string
{
    case SYSTEM = 'system';
    case USER = 'user';
}