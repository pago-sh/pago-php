<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * An active meter for a customer, with latest consumed and credited units.
 */
final class CustomerStateMeter implements Model, Deserializable
{
    public function __construct(
        public readonly string $id,
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $meter_id,
        public readonly float $consumed_units,
        public readonly int $credited_units,
        public readonly float $balance,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $id = Json::toString(Json::get($data, 'id'));
        $created_at = Json::toString(Json::get($data, 'created_at'));
        /** @var string|null $modified_at */
        $modified_at = (Json::get($data, 'modified_at') === null ? null : Json::toString(Json::get($data, 'modified_at')));
        $meter_id = Json::toString(Json::get($data, 'meter_id'));
        $consumed_units = Json::toFloat(Json::get($data, 'consumed_units'));
        $credited_units = Json::toInt(Json::get($data, 'credited_units'));
        $balance = Json::toFloat(Json::get($data, 'balance'));

        return new self(
            id: $id,
            created_at: $created_at,
            modified_at: $modified_at,
            meter_id: $meter_id,
            consumed_units: $consumed_units,
            credited_units: $credited_units,
            balance: $balance,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = Json::encode($this->id);
        $data['created_at'] = Json::encode($this->created_at);
        $data['modified_at'] = Json::encode($this->modified_at);
        $data['meter_id'] = Json::encode($this->meter_id);
        $data['consumed_units'] = Json::encode($this->consumed_units);
        $data['credited_units'] = Json::encode($this->credited_units);
        $data['balance'] = Json::encode($this->balance);

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