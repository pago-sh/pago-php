<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Serialization\Union;

/**
 * Builds the concrete {@see CustomerState} variant for a payload.
 *
 * Dispatch is driven by the `type` discriminator property.
 */
final class CustomerStateFactory implements Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): CustomerState
    {
        $resolved = Union::resolve($data, 'type', ['individual' => CustomerStateIndividual::class, 'team' => CustomerStateTeam::class], [CustomerStateIndividual::class, CustomerStateTeam::class]);

        if (!$resolved instanceof CustomerState) {
            throw new \Pago\Exception\PagoSerializationException(
                'Payload does not match any CustomerState variant.',
            );
        }

        return $resolved;
    }
}