<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Serialization\Union;

/**
 * Builds the concrete {@see CustomField} variant for a payload.
 *
 * Dispatch is driven by the `type` discriminator property.
 */
final class CustomFieldFactory implements Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): CustomField
    {
        $resolved = Union::resolve($data, 'type', ['checkbox' => CustomFieldCheckbox::class, 'date' => CustomFieldDate::class, 'number' => CustomFieldNumber::class, 'select' => CustomFieldSelect::class, 'text' => CustomFieldText::class], [CustomFieldText::class, CustomFieldNumber::class, CustomFieldDate::class, CustomFieldCheckbox::class, CustomFieldSelect::class]);

        if (!$resolved instanceof CustomField) {
            throw new \Pago\Exception\PagoSerializationException(
                'Payload does not match any CustomField variant.',
            );
        }

        return $resolved;
    }
}