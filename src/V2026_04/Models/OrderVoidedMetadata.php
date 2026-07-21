<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * OrderVoidedMetadata
 */
final class OrderVoidedMetadata implements Model, Deserializable
{
    public function __construct(
        public readonly string $order_id,
        public readonly int $amount,
        public readonly string $currency,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $order_id = Json::toString(Json::get($data, 'order_id'));
        $amount = Json::toInt(Json::get($data, 'amount'));
        $currency = Json::toString(Json::get($data, 'currency'));

        return new self(
            order_id: $order_id,
            amount: $amount,
            currency: $currency,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['order_id'] = Json::encode($this->order_id);
        $data['amount'] = Json::encode($this->amount);
        $data['currency'] = Json::encode($this->currency);

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