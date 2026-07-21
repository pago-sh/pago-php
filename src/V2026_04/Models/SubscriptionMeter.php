<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Current consumption and spending for a subscription meter.
 */
final class SubscriptionMeter implements Model, Deserializable
{
    public function __construct(
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $id,
        public readonly float $consumed_units,
        public readonly int $credited_units,
        public readonly int $amount,
        public readonly string $meter_id,
        public readonly Meter $meter,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $created_at = Json::toString(Json::get($data, 'created_at'));
        /** @var string|null $modified_at */
        $modified_at = (Json::get($data, 'modified_at') === null ? null : Json::toString(Json::get($data, 'modified_at')));
        $id = Json::toString(Json::get($data, 'id'));
        $consumed_units = Json::toFloat(Json::get($data, 'consumed_units'));
        $credited_units = Json::toInt(Json::get($data, 'credited_units'));
        $amount = Json::toInt(Json::get($data, 'amount'));
        $meter_id = Json::toString(Json::get($data, 'meter_id'));
        $meter = Meter::fromArray(Json::toMap(Json::get($data, 'meter')));

        return new self(
            created_at: $created_at,
            modified_at: $modified_at,
            id: $id,
            consumed_units: $consumed_units,
            credited_units: $credited_units,
            amount: $amount,
            meter_id: $meter_id,
            meter: $meter,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['created_at'] = Json::encode($this->created_at);
        $data['modified_at'] = Json::encode($this->modified_at);
        $data['id'] = Json::encode($this->id);
        $data['consumed_units'] = Json::encode($this->consumed_units);
        $data['credited_units'] = Json::encode($this->credited_units);
        $data['amount'] = Json::encode($this->amount);
        $data['meter_id'] = Json::encode($this->meter_id);
        $data['meter'] = Json::encode($this->meter);

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