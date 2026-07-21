<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * SubscriptionUpdate
 *
 * Implemented by every variant of this union:
 * - SubscriptionUpdateBase
 * - SubscriptionUpdateSeats
 * - SubscriptionUpdateBillingPeriod
 * - SubscriptionCancel
 * - SubscriptionRevoke
 * - SubscriptionPause
 * - SubscriptionResume
 * - SubscriptionUpdateClear
 *
 * Use {@see SubscriptionUpdateFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface SubscriptionUpdate extends Model
{
}