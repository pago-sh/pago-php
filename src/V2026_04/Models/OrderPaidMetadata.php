<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * OrderPaidMetadata
 */
final class OrderPaidMetadata implements Model, Deserializable
{
    public function __construct(
        public readonly string $order_id,
        public readonly int $amount,
        /**
         * @var string|null
         */
        public readonly ?string $product_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $billing_type = null,
        /**
         * @var string|null
         */
        public readonly ?string $currency = null,
        /**
         * @var int|null
         */
        public readonly ?int $net_amount = null,
        /**
         * @var int|null
         */
        public readonly ?int $tax_amount = null,
        /**
         * @var int|null
         */
        public readonly ?int $applied_balance_amount = null,
        /**
         * @var int|null
         */
        public readonly ?int $discount_amount = null,
        /**
         * @var string|null
         */
        public readonly ?string $discount_id = null,
        /**
         * @var int|null
         */
        public readonly ?int $platform_fee = null,
        /**
         * @var string|null
         */
        public readonly ?string $subscription_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $recurring_interval = null,
        /**
         * @var int|null
         */
        public readonly ?int $recurring_interval_count = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $order_id = Json::toString(Json::get($data, 'order_id'));
        $amount = Json::toInt(Json::get($data, 'amount'));
        /** @var string|null $product_id */
        $product_id = isset($data['product_id']) ? Json::toString($data['product_id']) : null;
        /** @var string|null $billing_type */
        $billing_type = isset($data['billing_type']) ? Json::toString($data['billing_type']) : null;
        /** @var string|null $currency */
        $currency = isset($data['currency']) ? Json::toString($data['currency']) : null;
        /** @var int|null $net_amount */
        $net_amount = isset($data['net_amount']) ? Json::toInt($data['net_amount']) : null;
        /** @var int|null $tax_amount */
        $tax_amount = isset($data['tax_amount']) ? Json::toInt($data['tax_amount']) : null;
        /** @var int|null $applied_balance_amount */
        $applied_balance_amount = isset($data['applied_balance_amount']) ? Json::toInt($data['applied_balance_amount']) : null;
        /** @var int|null $discount_amount */
        $discount_amount = isset($data['discount_amount']) ? Json::toInt($data['discount_amount']) : null;
        /** @var string|null $discount_id */
        $discount_id = isset($data['discount_id']) ? Json::toString($data['discount_id']) : null;
        /** @var int|null $platform_fee */
        $platform_fee = isset($data['platform_fee']) ? Json::toInt($data['platform_fee']) : null;
        /** @var string|null $subscription_id */
        $subscription_id = isset($data['subscription_id']) ? Json::toString($data['subscription_id']) : null;
        /** @var string|null $recurring_interval */
        $recurring_interval = isset($data['recurring_interval']) ? Json::toString($data['recurring_interval']) : null;
        /** @var int|null $recurring_interval_count */
        $recurring_interval_count = isset($data['recurring_interval_count']) ? Json::toInt($data['recurring_interval_count']) : null;

        return new self(
            order_id: $order_id,
            amount: $amount,
            product_id: $product_id,
            billing_type: $billing_type,
            currency: $currency,
            net_amount: $net_amount,
            tax_amount: $tax_amount,
            applied_balance_amount: $applied_balance_amount,
            discount_amount: $discount_amount,
            discount_id: $discount_id,
            platform_fee: $platform_fee,
            subscription_id: $subscription_id,
            recurring_interval: $recurring_interval,
            recurring_interval_count: $recurring_interval_count,
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
        if ($this->product_id !== null) {
            $data['product_id'] = Json::encode($this->product_id);
        }
        if ($this->billing_type !== null) {
            $data['billing_type'] = Json::encode($this->billing_type);
        }
        if ($this->currency !== null) {
            $data['currency'] = Json::encode($this->currency);
        }
        if ($this->net_amount !== null) {
            $data['net_amount'] = Json::encode($this->net_amount);
        }
        if ($this->tax_amount !== null) {
            $data['tax_amount'] = Json::encode($this->tax_amount);
        }
        if ($this->applied_balance_amount !== null) {
            $data['applied_balance_amount'] = Json::encode($this->applied_balance_amount);
        }
        if ($this->discount_amount !== null) {
            $data['discount_amount'] = Json::encode($this->discount_amount);
        }
        if ($this->discount_id !== null) {
            $data['discount_id'] = Json::encode($this->discount_id);
        }
        if ($this->platform_fee !== null) {
            $data['platform_fee'] = Json::encode($this->platform_fee);
        }
        if ($this->subscription_id !== null) {
            $data['subscription_id'] = Json::encode($this->subscription_id);
        }
        if ($this->recurring_interval !== null) {
            $data['recurring_interval'] = Json::encode($this->recurring_interval);
        }
        if ($this->recurring_interval_count !== null) {
            $data['recurring_interval_count'] = Json::encode($this->recurring_interval_count);
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