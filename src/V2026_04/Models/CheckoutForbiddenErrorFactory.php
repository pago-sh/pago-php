<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Serialization\Union;

/**
 * Builds the concrete {@see CheckoutForbiddenError} variant for a payload.
 *
 * The schema declares no discriminator, so variants are tried in declaration
 * order and the first one that decodes cleanly is returned.
 */
final class CheckoutForbiddenErrorFactory implements Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): CheckoutForbiddenError
    {
        $resolved = Union::resolve($data, null, [], [AlreadyActiveSubscriptionError::class, NotOpenCheckout::class, PaymentNotReady::class, TrialAlreadyRedeemed::class]);

        if (!$resolved instanceof CheckoutForbiddenError) {
            throw new \Pago\Exception\PagoSerializationException(
                'Payload does not match any CheckoutForbiddenError variant.',
            );
        }

        return $resolved;
    }
}