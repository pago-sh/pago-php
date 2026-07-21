<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * PaymentStatus
 */
enum PaymentStatus: string
{
    case PENDING = 'pending';
    case SUCCEEDED = 'succeeded';
    case FAILED = 'failed';
}