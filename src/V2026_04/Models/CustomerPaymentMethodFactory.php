<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Serialization\Union;

/**
 * Builds the concrete {@see CustomerPaymentMethod} variant for a payload.
 *
 * The schema declares no discriminator, so variants are tried in declaration
 * order and the first one that decodes cleanly is returned.
 */
final class CustomerPaymentMethodFactory implements Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): CustomerPaymentMethod
    {
        $resolved = Union::resolve($data, null, [], [PaymentMethodCard::class, PaymentMethodGeneric::class]);

        if (!$resolved instanceof CustomerPaymentMethod) {
            throw new \Pago\Exception\PagoSerializationException(
                'Payload does not match any CustomerPaymentMethod variant.',
            );
        }

        return $resolved;
    }
}