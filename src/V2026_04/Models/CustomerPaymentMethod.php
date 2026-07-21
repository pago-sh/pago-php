<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * CustomerPaymentMethod
 *
 * Implemented by every variant of this union:
 * - PaymentMethodCard
 * - PaymentMethodGeneric
 *
 * Use {@see CustomerPaymentMethodFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface CustomerPaymentMethod extends Model
{
}