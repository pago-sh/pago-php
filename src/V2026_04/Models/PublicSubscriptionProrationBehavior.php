<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * PublicSubscriptionProrationBehavior
 */
enum PublicSubscriptionProrationBehavior: string
{
    case INVOICE = 'invoice';
    case PRORATE = 'prorate';
    case NEXT_PERIOD = 'next_period';
}