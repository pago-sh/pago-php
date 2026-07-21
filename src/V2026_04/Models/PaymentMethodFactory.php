<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Serialization\Union;

/**
 * Builds the concrete {@see PaymentMethod} variant for a payload.
 *
 * The schema declares no discriminator, so variants are tried in declaration
 * order and the first one that decodes cleanly is returned.
 */
final class PaymentMethodFactory implements Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): PaymentMethod
    {
        $resolved = Union::resolve($data, null, [], [CustomerPaymentMethodCard::class, CustomerPaymentMethodGeneric::class]);

        if (!$resolved instanceof PaymentMethod) {
            throw new \Pago\Exception\PagoSerializationException(
                'Payload does not match any PaymentMethod variant.',
            );
        }

        return $resolved;
    }
}