<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * CheckoutLinkCreate
 *
 * Implemented by every variant of this union:
 * - CheckoutLinkCreateProductPrice
 * - CheckoutLinkCreateProduct
 * - CheckoutLinkCreateProducts
 *
 * Use {@see CheckoutLinkCreateFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface CheckoutLinkCreate extends Model
{
}