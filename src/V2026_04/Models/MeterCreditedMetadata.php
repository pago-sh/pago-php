<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * MeterCreditedMetadata
 */
final class MeterCreditedMetadata implements Model, Deserializable
{
    public function __construct(
        public readonly string $meter_id,
        public readonly int $units,
        public readonly bool $rollover,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $meter_id = Json::toString(Json::get($data, 'meter_id'));
        $units = Json::toInt(Json::get($data, 'units'));
        $rollover = Json::toBool(Json::get($data, 'rollover'));

        return new self(
            meter_id: $meter_id,
            units: $units,
            rollover: $rollover,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['meter_id'] = Json::encode($this->meter_id);
        $data['units'] = Json::encode($this->units);
        $data['rollover'] = Json::encode($this->rollover);

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