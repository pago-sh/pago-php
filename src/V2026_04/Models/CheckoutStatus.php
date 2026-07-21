<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * CheckoutStatus
 */
enum CheckoutStatus: string
{
    case OPEN = 'open';
    case EXPIRED = 'expired';
    case CONFIRMED = 'confirmed';
    case SUCCEEDED = 'succeeded';
    case FAILED = 'failed';
}