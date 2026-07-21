<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * BenefitGrantMeterCreditProperties
 */
final class BenefitGrantMeterCreditProperties implements Model, Deserializable
{
    public function __construct(
        /**
         * @var string|null
         */
        public readonly ?string $last_credited_meter_id = null,
        /**
         * @var int|null
         */
        public readonly ?int $last_credited_units = null,
        /**
         * @var string|null
         */
        public readonly ?string $last_credited_at = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var string|null $last_credited_meter_id */
        $last_credited_meter_id = isset($data['last_credited_meter_id']) ? Json::toString($data['last_credited_meter_id']) : null;
        /** @var int|null $last_credited_units */
        $last_credited_units = isset($data['last_credited_units']) ? Json::toInt($data['last_credited_units']) : null;
        /** @var string|null $last_credited_at */
        $last_credited_at = isset($data['last_credited_at']) ? Json::toString($data['last_credited_at']) : null;

        return new self(
            last_credited_meter_id: $last_credited_meter_id,
            last_credited_units: $last_credited_units,
            last_credited_at: $last_credited_at,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->last_credited_meter_id !== null) {
            $data['last_credited_meter_id'] = Json::encode($this->last_credited_meter_id);
        }
        if ($this->last_credited_units !== null) {
            $data['last_credited_units'] = Json::encode($this->last_credited_units);
        }
        if ($this->last_credited_at !== null) {
            $data['last_credited_at'] = Json::encode($this->last_credited_at);
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