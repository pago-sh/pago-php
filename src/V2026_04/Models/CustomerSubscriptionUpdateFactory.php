<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Serialization\Union;

/**
 * Builds the concrete {@see CustomerSubscriptionUpdate} variant for a payload.
 *
 * The schema declares no discriminator, so variants are tried in declaration
 * order and the first one that decodes cleanly is returned.
 */
final class CustomerSubscriptionUpdateFactory implements Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): CustomerSubscriptionUpdate
    {
        $resolved = Union::resolve($data, null, [], [CustomerSubscriptionUpdateProduct::class, CustomerSubscriptionUpdateSeats::class, CustomerSubscriptionCancel::class, CustomerSubscriptionPause::class, CustomerSubscriptionResume::class, CustomerSubscriptionUpdateClear::class]);

        if (!$resolved instanceof CustomerSubscriptionUpdate) {
            throw new \Pago\Exception\PagoSerializationException(
                'Payload does not match any CustomerSubscriptionUpdate variant.',
            );
        }

        return $resolved;
    }
}