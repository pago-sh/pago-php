<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * CustomerSubscriptionUpdate
 *
 * Implemented by every variant of this union:
 * - CustomerSubscriptionUpdateProduct
 * - CustomerSubscriptionUpdateSeats
 * - CustomerSubscriptionCancel
 * - CustomerSubscriptionPause
 * - CustomerSubscriptionResume
 * - CustomerSubscriptionUpdateClear
 *
 * Use {@see CustomerSubscriptionUpdateFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface CustomerSubscriptionUpdate extends Model
{
}