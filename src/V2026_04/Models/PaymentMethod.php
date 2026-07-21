<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * PaymentMethod
 *
 * Implemented by every variant of this union:
 * - CustomerPaymentMethodCard
 * - CustomerPaymentMethodGeneric
 *
 * Use {@see PaymentMethodFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface PaymentMethod extends Model
{
}