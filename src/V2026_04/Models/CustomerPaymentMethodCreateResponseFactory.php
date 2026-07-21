<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Serialization\Union;

/**
 * Builds the concrete {@see CustomerPaymentMethodCreateResponse} variant for a payload.
 *
 * Dispatch is driven by the `status` discriminator property.
 */
final class CustomerPaymentMethodCreateResponseFactory implements Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): CustomerPaymentMethodCreateResponse
    {
        $resolved = Union::resolve($data, 'status', ['requires_action' => CustomerPaymentMethodCreateRequiresActionResponse::class, 'succeeded' => CustomerPaymentMethodCreateSucceededResponse::class], [CustomerPaymentMethodCreateSucceededResponse::class, CustomerPaymentMethodCreateRequiresActionResponse::class]);

        if (!$resolved instanceof CustomerPaymentMethodCreateResponse) {
            throw new \Pago\Exception\PagoSerializationException(
                'Payload does not match any CustomerPaymentMethodCreateResponse variant.',
            );
        }

        return $resolved;
    }
}