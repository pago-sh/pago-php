<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * CustomerCancellationReason
 */
enum CustomerCancellationReason: string
{
    case CUSTOMER_SERVICE = 'customer_service';
    case LOW_QUALITY = 'low_quality';
    case MISSING_FEATURES = 'missing_features';
    case SWITCHED_SERVICE = 'switched_service';
    case TOO_COMPLEX = 'too_complex';
    case TOO_EXPENSIVE = 'too_expensive';
    case UNUSED = 'unused';
    case OTHER = 'other';
}