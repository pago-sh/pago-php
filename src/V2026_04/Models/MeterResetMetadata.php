<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * MeterResetMetadata
 */
final class MeterResetMetadata implements Model, Deserializable
{
    public function __construct(
        public readonly string $meter_id,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $meter_id = Json::toString(Json::get($data, 'meter_id'));

        return new self(
            meter_id: $meter_id,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['meter_id'] = Json::encode($this->meter_id);

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