<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Serialization\Union;

/**
 * Builds the concrete {@see Customer} variant for a payload.
 *
 * Dispatch is driven by the `type` discriminator property.
 */
final class CustomerFactory implements Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): Customer
    {
        $resolved = Union::resolve($data, 'type', ['individual' => CustomerIndividual::class, 'team' => CustomerTeam::class], [CustomerIndividual::class, CustomerTeam::class]);

        if (!$resolved instanceof Customer) {
            throw new \Pago\Exception\PagoSerializationException(
                'Payload does not match any Customer variant.',
            );
        }

        return $resolved;
    }
}