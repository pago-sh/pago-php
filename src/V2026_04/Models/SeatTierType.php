<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * SeatTierType
 */
enum SeatTierType: string
{
    case VOLUME = 'volume';
    case GRADUATED = 'graduated';
}