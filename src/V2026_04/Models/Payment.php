<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * Payment
 *
 * Implemented by every variant of this union:
 * - CardPayment
 * - GenericPayment
 *
 * Use {@see PaymentFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface Payment extends Model
{
}