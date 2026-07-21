<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Serialization\Union;

/**
 * Builds the concrete {@see Event} variant for a payload.
 *
 * Dispatch is driven by the `source` discriminator property.
 */
final class EventFactory implements Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): Event
    {
        $resolved = Union::resolve($data, 'source', ['system' => SystemEventFactory::class, 'user' => UserEvent::class], [SystemEventFactory::class, UserEvent::class]);

        if (!$resolved instanceof Event) {
            throw new \Pago\Exception\PagoSerializationException(
                'Payload does not match any Event variant.',
            );
        }

        return $resolved;
    }
}