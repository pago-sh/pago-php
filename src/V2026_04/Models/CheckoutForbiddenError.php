<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * CheckoutForbiddenError
 *
 * Implemented by every variant of this union:
 * - AlreadyActiveSubscriptionError
 * - NotOpenCheckout
 * - PaymentNotReady
 * - TrialAlreadyRedeemed
 *
 * Use {@see CheckoutForbiddenErrorFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface CheckoutForbiddenError extends Model
{
}