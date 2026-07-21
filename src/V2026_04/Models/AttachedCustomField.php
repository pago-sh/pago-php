<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema of a custom field attached to a resource.
 */
final class AttachedCustomField implements Model, Deserializable
{
    public function __construct(
        public readonly string $custom_field_id,
        public readonly CustomField $custom_field,
        public readonly int $order,
        public readonly bool $required,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $custom_field_id = Json::toString(Json::get($data, 'custom_field_id'));
        $custom_field = CustomFieldFactory::fromArray(Json::toMap(Json::get($data, 'custom_field')));
        $order = Json::toInt(Json::get($data, 'order'));
        $required = Json::toBool(Json::get($data, 'required'));

        return new self(
            custom_field_id: $custom_field_id,
            custom_field: $custom_field,
            order: $order,
            required: $required,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['custom_field_id'] = Json::encode($this->custom_field_id);
        $data['custom_field'] = Json::encode($this->custom_field);
        $data['order'] = Json::encode($this->order);
        $data['required'] = Json::encode($this->required);

        return $data;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}