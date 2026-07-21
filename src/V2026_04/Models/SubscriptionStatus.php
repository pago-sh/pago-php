<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * SubscriptionStatus
 */
enum SubscriptionStatus: string
{
    case INCOMPLETE = 'incomplete';
    case INCOMPLETE_EXPIRED = 'incomplete_expired';
    case TRIALING = 'trialing';
    case ACTIVE = 'active';
    case PAST_DUE = 'past_due';
    case CANCELED = 'canceled';
    case UNPAID = 'unpaid';
    case PAUSED = 'paused';
}