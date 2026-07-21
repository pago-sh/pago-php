<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * EventName
 */
final class EventName implements Model, Deserializable
{
    public function __construct(
        public readonly string $name,
        public readonly string $label,
        public readonly EventSource $source,
        public readonly int $occurrences,
        public readonly string $first_seen,
        public readonly string $last_seen,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $name = Json::toString(Json::get($data, 'name'));
        $label = Json::toString(Json::get($data, 'label'));
        $source = EventSource::from(Json::toString(Json::get($data, 'source')));
        $occurrences = Json::toInt(Json::get($data, 'occurrences'));
        $first_seen = Json::toString(Json::get($data, 'first_seen'));
        $last_seen = Json::toString(Json::get($data, 'last_seen'));

        return new self(
            name: $name,
            label: $label,
            source: $source,
            occurrences: $occurrences,
            first_seen: $first_seen,
            last_seen: $last_seen,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['name'] = Json::encode($this->name);
        $data['label'] = Json::encode($this->label);
        $data['source'] = Json::encode($this->source);
        $data['occurrences'] = Json::encode($this->occurrences);
        $data['first_seen'] = Json::encode($this->first_seen);
        $data['last_seen'] = Json::encode($this->last_seen);

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