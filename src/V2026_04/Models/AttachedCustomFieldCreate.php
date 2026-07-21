<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema to attach a custom field to a resource.
 */
final class AttachedCustomFieldCreate implements Model, Deserializable
{
    public function __construct(
        public readonly string $custom_field_id,
        public readonly bool $required,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $custom_field_id = Json::toString(Json::get($data, 'custom_field_id'));
        $required = Json::toBool(Json::get($data, 'required'));

        return new self(
            custom_field_id: $custom_field_id,
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