<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * CustomerPaymentMethodCreateResponse
 *
 * Implemented by every variant of this union:
 * - CustomerPaymentMethodCreateSucceededResponse
 * - CustomerPaymentMethodCreateRequiresActionResponse
 *
 * Use {@see CustomerPaymentMethodCreateResponseFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface CustomerPaymentMethodCreateResponse extends Model
{
}