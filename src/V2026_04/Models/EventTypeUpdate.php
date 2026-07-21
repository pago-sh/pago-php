<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * EventTypeUpdate
 */
final class EventTypeUpdate implements Model, Deserializable
{
    public function __construct(
        public readonly string $label,
        /**
         * @var string|null
         */
        public readonly ?string $label_property_selector = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $label = Json::toString(Json::get($data, 'label'));
        /** @var string|null $label_property_selector */
        $label_property_selector = isset($data['label_property_selector']) ? Json::toString($data['label_property_selector']) : null;

        return new self(
            label: $label,
            label_property_selector: $label_property_selector,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['label'] = Json::encode($this->label);
        if ($this->label_property_selector !== null) {
            $data['label_property_selector'] = Json::encode($this->label_property_selector);
        }

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