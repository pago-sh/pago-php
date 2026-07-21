<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * OrderBillingReason
 */
enum OrderBillingReason: string
{
    case PURCHASE = 'purchase';
    case SUBSCRIPTION_CREATE = 'subscription_create';
    case SUBSCRIPTION_CYCLE = 'subscription_cycle';
    case SUBSCRIPTION_UPDATE = 'subscription_update';
}