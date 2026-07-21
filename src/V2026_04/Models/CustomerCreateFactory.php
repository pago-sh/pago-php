<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Serialization\Union;

/**
 * Builds the concrete {@see CustomerCreate} variant for a payload.
 *
 * The schema declares no discriminator, so variants are tried in declaration
 * order and the first one that decodes cleanly is returned.
 */
final class CustomerCreateFactory implements Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): CustomerCreate
    {
        $resolved = Union::resolve($data, null, [], [CustomerIndividualCreate::class, CustomerTeamCreate::class]);

        if (!$resolved instanceof CustomerCreate) {
            throw new \Pago\Exception\PagoSerializationException(
                'Payload does not match any CustomerCreate variant.',
            );
        }

        return $resolved;
    }
}