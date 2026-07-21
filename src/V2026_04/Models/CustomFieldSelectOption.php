<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomFieldSelectOption
 */
final class CustomFieldSelectOption implements Model, Deserializable
{
    public function __construct(
        public readonly string $value,
        public readonly string $label,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $value = Json::toString(Json::get($data, 'value'));
        $label = Json::toString(Json::get($data, 'label'));

        return new self(
            value: $value,
            label: $label,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['value'] = Json::encode($this->value);
        $data['label'] = Json::encode($this->label);

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