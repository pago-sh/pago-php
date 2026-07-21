<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * DiscountCreate
 *
 * Implemented by every variant of this union:
 * - DiscountFixedCreate
 * - DiscountPercentageCreate
 *
 * Use {@see DiscountCreateFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface DiscountCreate extends Model
{
}