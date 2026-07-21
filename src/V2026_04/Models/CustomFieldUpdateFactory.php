<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Serialization\Union;

/**
 * Builds the concrete {@see CustomFieldUpdate} variant for a payload.
 *
 * Dispatch is driven by the `type` discriminator property.
 */
final class CustomFieldUpdateFactory implements Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): CustomFieldUpdate
    {
        $resolved = Union::resolve($data, 'type', ['checkbox' => CustomFieldUpdateCheckbox::class, 'date' => CustomFieldUpdateDate::class, 'number' => CustomFieldUpdateNumber::class, 'select' => CustomFieldUpdateSelect::class, 'text' => CustomFieldUpdateText::class], [CustomFieldUpdateText::class, CustomFieldUpdateNumber::class, CustomFieldUpdateDate::class, CustomFieldUpdateCheckbox::class, CustomFieldUpdateSelect::class]);

        if (!$resolved instanceof CustomFieldUpdate) {
            throw new \Pago\Exception\PagoSerializationException(
                'Payload does not match any CustomFieldUpdate variant.',
            );
        }

        return $resolved;
    }
}