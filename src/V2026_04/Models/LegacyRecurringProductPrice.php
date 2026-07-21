<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * LegacyRecurringProductPrice
 *
 * Implemented by every variant of this union:
 * - LegacyRecurringProductPriceFixed
 * - LegacyRecurringProductPriceCustom
 *
 * Use {@see LegacyRecurringProductPriceFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface LegacyRecurringProductPrice extends Model
{
}