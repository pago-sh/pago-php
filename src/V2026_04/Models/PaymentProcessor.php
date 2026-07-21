<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * PaymentProcessor
 */
enum PaymentProcessor: string
{
    case STRIPE = 'stripe';
}