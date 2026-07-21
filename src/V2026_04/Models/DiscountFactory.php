<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Serialization\Union;

/**
 * Builds the concrete {@see Discount} variant for a payload.
 *
 * The schema declares no discriminator, so variants are tried in declaration
 * order and the first one that decodes cleanly is returned.
 */
final class DiscountFactory implements Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): Discount
    {
        $resolved = Union::resolve($data, null, [], [DiscountFixedOnceForeverDuration::class, DiscountFixedRepeatDuration::class, DiscountPercentageOnceForeverDuration::class, DiscountPercentageRepeatDuration::class]);

        if (!$resolved instanceof Discount) {
            throw new \Pago\Exception\PagoSerializationException(
                'Payload does not match any Discount variant.',
            );
        }

        return $resolved;
    }
}