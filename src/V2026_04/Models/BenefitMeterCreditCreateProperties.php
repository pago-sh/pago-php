<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Properties for creating a benefit of type `meter_unit`.
 */
final class BenefitMeterCreditCreateProperties implements Model, Deserializable
{
    public function __construct(
        public readonly int $units,
        public readonly bool $rollover,
        public readonly string $meter_id,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $units = Json::toInt(Json::get($data, 'units'));
        $rollover = Json::toBool(Json::get($data, 'rollover'));
        $meter_id = Json::toString(Json::get($data, 'meter_id'));

        return new self(
            units: $units,
            rollover: $rollover,
            meter_id: $meter_id,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['units'] = Json::encode($this->units);
        $data['rollover'] = Json::encode($this->rollover);
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