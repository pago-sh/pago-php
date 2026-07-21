<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Serialization\Union;

/**
 * Builds the concrete {@see CheckoutLinkCreate} variant for a payload.
 *
 * The schema declares no discriminator, so variants are tried in declaration
 * order and the first one that decodes cleanly is returned.
 */
final class CheckoutLinkCreateFactory implements Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): CheckoutLinkCreate
    {
        $resolved = Union::resolve($data, null, [], [CheckoutLinkCreateProductPrice::class, CheckoutLinkCreateProduct::class, CheckoutLinkCreateProducts::class]);

        if (!$resolved instanceof CheckoutLinkCreate) {
            throw new \Pago\Exception\PagoSerializationException(
                'Payload does not match any CheckoutLinkCreate variant.',
            );
        }

        return $resolved;
    }
}