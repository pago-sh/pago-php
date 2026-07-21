<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Serialization\Union;

/**
 * Builds the concrete {@see LegacyRecurringProductPrice} variant for a payload.
 *
 * Dispatch is driven by the `amount_type` discriminator property.
 */
final class LegacyRecurringProductPriceFactory implements Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): LegacyRecurringProductPrice
    {
        $resolved = Union::resolve($data, 'amount_type', ['custom' => LegacyRecurringProductPriceCustom::class, 'fixed' => LegacyRecurringProductPriceFixed::class], [LegacyRecurringProductPriceFixed::class, LegacyRecurringProductPriceCustom::class]);

        if (!$resolved instanceof LegacyRecurringProductPrice) {
            throw new \Pago\Exception\PagoSerializationException(
                'Payload does not match any LegacyRecurringProductPrice variant.',
            );
        }

        return $resolved;
    }
}