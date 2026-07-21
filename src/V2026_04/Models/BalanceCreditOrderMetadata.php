<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * BalanceCreditOrderMetadata
 */
final class BalanceCreditOrderMetadata implements Model, Deserializable
{
    public function __construct(
        public readonly string $order_id,
        public readonly int $amount,
        public readonly string $currency,
        public readonly int $tax_amount,
        public readonly int $fee,
        /**
         * @var string|null
         */
        public readonly ?string $product_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $subscription_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $tax_state = null,
        /**
         * @var string|null
         */
        public readonly ?string $tax_country = null,
        /**
         * @var float|null
         */
        public readonly ?float $exchange_rate = null,
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
        $tax_amount = Json::toInt(Json::get($data, 'tax_amount'));
        $fee = Json::toInt(Json::get($data, 'fee'));
        /** @var string|null $product_id */
        $product_id = isset($data['product_id']) ? Json::toString($data['product_id']) : null;
        /** @var string|null $subscription_id */
        $subscription_id = isset($data['subscription_id']) ? Json::toString($data['subscription_id']) : null;
        /** @var string|null $tax_state */
        $tax_state = isset($data['tax_state']) ? Json::toString($data['tax_state']) : null;
        /** @var string|null $tax_country */
        $tax_country = isset($data['tax_country']) ? Json::toString($data['tax_country']) : null;
        /** @var float|null $exchange_rate */
        $exchange_rate = isset($data['exchange_rate']) ? Json::toFloat($data['exchange_rate']) : null;

        return new self(
            order_id: $order_id,
            amount: $amount,
            currency: $currency,
            tax_amount: $tax_amount,
            fee: $fee,
            product_id: $product_id,
            subscription_id: $subscription_id,
            tax_state: $tax_state,
            tax_country: $tax_country,
            exchange_rate: $exchange_rate,
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
        $data['tax_amount'] = Json::encode($this->tax_amount);
        $data['fee'] = Json::encode($this->fee);
        if ($this->product_id !== null) {
            $data['product_id'] = Json::encode($this->product_id);
        }
        if ($this->subscription_id !== null) {
            $data['subscription_id'] = Json::encode($this->subscription_id);
        }
        if ($this->tax_state !== null) {
            $data['tax_state'] = Json::encode($this->tax_state);
        }
        if ($this->tax_country !== null) {
            $data['tax_country'] = Json::encode($this->tax_country);
        }
        if ($this->exchange_rate !== null) {
            $data['exchange_rate'] = Json::encode($this->exchange_rate);
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