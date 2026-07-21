<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * SeatStatus
 */
enum SeatStatus: string
{
    case PENDING = 'pending';
    case CLAIMED = 'claimed';
    case REVOKED = 'revoked';
}