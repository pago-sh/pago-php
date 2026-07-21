<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * PaymentTrigger
 */
enum PaymentTrigger: string
{
    case PURCHASE = 'purchase';
    case SUBSCRIPTION_CYCLE = 'subscription_cycle';
    case RETRY_DUNNING = 'retry_dunning';
    case RETRY_CUSTOMER = 'retry_customer';
    case RETRY_PAYMENT_METHOD_UPDATE = 'retry_payment_method_update';
    case RETRY_ADMIN = 'retry_admin';
}