<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * Discount
 *
 * Implemented by every variant of this union:
 * - DiscountFixedOnceForeverDuration
 * - DiscountFixedRepeatDuration
 * - DiscountPercentageOnceForeverDuration
 * - DiscountPercentageRepeatDuration
 *
 * Use {@see DiscountFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface Discount extends Model
{
}