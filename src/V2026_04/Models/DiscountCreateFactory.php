<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Serialization\Union;

/**
 * Builds the concrete {@see DiscountCreate} variant for a payload.
 *
 * Dispatch is driven by the `type` discriminator property.
 */
final class DiscountCreateFactory implements Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): DiscountCreate
    {
        $resolved = Union::resolve($data, 'type', ['fixed' => DiscountFixedCreate::class, 'percentage' => DiscountPercentageCreate::class], [DiscountFixedCreate::class, DiscountPercentageCreate::class]);

        if (!$resolved instanceof DiscountCreate) {
            throw new \Pago\Exception\PagoSerializationException(
                'Payload does not match any DiscountCreate variant.',
            );
        }

        return $resolved;
    }
}