<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * MeterQuantity
 */
final class MeterQuantity implements Model, Deserializable
{
    public function __construct(
        public readonly string $timestamp,
        public readonly float $quantity,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $timestamp = Json::toString(Json::get($data, 'timestamp'));
        $quantity = Json::toFloat(Json::get($data, 'quantity'));

        return new self(
            timestamp: $timestamp,
            quantity: $quantity,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['timestamp'] = Json::encode($this->timestamp);
        $data['quantity'] = Json::encode($this->quantity);

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