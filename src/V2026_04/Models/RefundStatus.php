<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * RefundStatus
 */
enum RefundStatus: string
{
    case PENDING = 'pending';
    case SUCCEEDED = 'succeeded';
    case FAILED = 'failed';
    case CANCELED = 'canceled';
}