<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * EventsIngestResponse
 */
final class EventsIngestResponse implements Model, Deserializable
{
    public function __construct(
        public readonly int $inserted,
        /**
         * @var int|null
         */
        public readonly ?int $duplicates = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $inserted = Json::toInt(Json::get($data, 'inserted'));
        /** @var int|null $duplicates */
        $duplicates = isset($data['duplicates']) ? Json::toInt($data['duplicates']) : null;

        return new self(
            inserted: $inserted,
            duplicates: $duplicates,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['inserted'] = Json::encode($this->inserted);
        if ($this->duplicates !== null) {
            $data['duplicates'] = Json::encode($this->duplicates);
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