<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * MeterQuantities
 */
final class MeterQuantities implements Model, Deserializable
{
    public function __construct(
        /**
         * @var list<MeterQuantity>
         */
        public readonly array $quantities,
        public readonly float $total,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var list<MeterQuantity> $quantities */
        $quantities = array_map(static fn (mixed $item0): MeterQuantity => MeterQuantity::fromArray(Json::toMap($item0)), Json::toList(Json::get($data, 'quantities')));
        $total = Json::toFloat(Json::get($data, 'total'));

        return new self(
            quantities: $quantities,
            total: $total,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['quantities'] = Json::encode($this->quantities);
        $data['total'] = Json::encode($this->total);

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