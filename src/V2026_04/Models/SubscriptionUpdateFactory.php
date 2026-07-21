<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Serialization\Union;

/**
 * Builds the concrete {@see SubscriptionUpdate} variant for a payload.
 *
 * The schema declares no discriminator, so variants are tried in declaration
 * order and the first one that decodes cleanly is returned.
 */
final class SubscriptionUpdateFactory implements Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): SubscriptionUpdate
    {
        $resolved = Union::resolve($data, null, [], [SubscriptionUpdateBase::class, SubscriptionUpdateSeats::class, SubscriptionUpdateBillingPeriod::class, SubscriptionCancel::class, SubscriptionRevoke::class, SubscriptionPause::class, SubscriptionResume::class, SubscriptionUpdateClear::class]);

        if (!$resolved instanceof SubscriptionUpdate) {
            throw new \Pago\Exception\PagoSerializationException(
                'Payload does not match any SubscriptionUpdate variant.',
            );
        }

        return $resolved;
    }
}