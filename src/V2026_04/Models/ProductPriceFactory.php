<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Serialization\Union;

/**
 * Builds the concrete {@see ProductPrice} variant for a payload.
 *
 * Dispatch is driven by the `amount_type` discriminator property.
 */
final class ProductPriceFactory implements Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): ProductPrice
    {
        $resolved = Union::resolve($data, 'amount_type', ['custom' => ProductPriceCustom::class, 'fixed' => ProductPriceFixed::class, 'metered_unit' => ProductPriceMeteredUnit::class, 'seat_based' => ProductPriceSeatBased::class], [ProductPriceFixed::class, ProductPriceCustom::class, ProductPriceSeatBased::class, ProductPriceMeteredUnit::class]);

        if (!$resolved instanceof ProductPrice) {
            throw new \Pago\Exception\PagoSerializationException(
                'Payload does not match any ProductPrice variant.',
            );
        }

        return $resolved;
    }
}