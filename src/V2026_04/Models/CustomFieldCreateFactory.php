<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Serialization\Union;

/**
 * Builds the concrete {@see CustomFieldCreate} variant for a payload.
 *
 * Dispatch is driven by the `type` discriminator property.
 */
final class CustomFieldCreateFactory implements Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): CustomFieldCreate
    {
        $resolved = Union::resolve($data, 'type', ['checkbox' => CustomFieldCreateCheckbox::class, 'date' => CustomFieldCreateDate::class, 'number' => CustomFieldCreateNumber::class, 'select' => CustomFieldCreateSelect::class, 'text' => CustomFieldCreateText::class], [CustomFieldCreateText::class, CustomFieldCreateNumber::class, CustomFieldCreateDate::class, CustomFieldCreateCheckbox::class, CustomFieldCreateSelect::class]);

        if (!$resolved instanceof CustomFieldCreate) {
            throw new \Pago\Exception\PagoSerializationException(
                'Payload does not match any CustomFieldCreate variant.',
            );
        }

        return $resolved;
    }
}