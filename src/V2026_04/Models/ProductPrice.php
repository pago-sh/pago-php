<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * ProductPrice
 *
 * Implemented by every variant of this union:
 * - ProductPriceFixed
 * - ProductPriceCustom
 * - ProductPriceSeatBased
 * - ProductPriceMeteredUnit
 *
 * Use {@see ProductPriceFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface ProductPrice extends Model
{
}