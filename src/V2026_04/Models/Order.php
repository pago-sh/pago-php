<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Order
 */
final class Order implements Model, Deserializable
{
    public function __construct(
        public readonly string $id,
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly OrderStatus $status,
        public readonly bool $paid,
        public readonly int $subtotal_amount,
        public readonly int $discount_amount,
        public readonly int $net_amount,
        public readonly int $tax_amount,
        public readonly int $total_amount,
        public readonly int $applied_balance_amount,
        public readonly int $due_amount,
        public readonly int $refunded_amount,
        public readonly int $refunded_tax_amount,
        public readonly string $currency,
        public readonly OrderBillingReason $billing_reason,
        /**
         * @var string|null
         */
        public readonly ?string $billing_name,
        /**
         * @var Address|null
         */
        public readonly ?Address $billing_address,
        /**
         * @var string|null
         */
        public readonly ?string $invoice_number,
        public readonly bool $is_invoice_generated,
        /**
         * @var string|null
         */
        public readonly ?string $receipt_number,
        public readonly string $customer_id,
        /**
         * @var string|null
         */
        public readonly ?string $product_id,
        /**
         * @var string|null
         */
        public readonly ?string $discount_id,
        /**
         * @var string|null
         */
        public readonly ?string $subscription_id,
        /**
         * @var string|null
         */
        public readonly ?string $checkout_id,
        /**
         * @var array<string, string|int|float|bool>
         */
        public readonly array $metadata,
        public readonly int $platform_fee_amount,
        /**
         * @var string|null
         */
        public readonly ?string $platform_fee_currency,
        public readonly OrderCustomer $customer,
        /**
         * @var OrderProduct|null
         */
        public readonly ?OrderProduct $product,
        public readonly DiscountFixedOnceForeverDurationBase|DiscountFixedRepeatDurationBase|DiscountPercentageOnceForeverDurationBase|DiscountPercentageRepeatDurationBase|null $discount,
        /**
         * @var OrderSubscription|null
         */
        public readonly ?OrderSubscription $subscription,
        /**
         * @var list<OrderItemSchema>
         */
        public readonly array $items,
        public readonly string $description,
        public readonly int $refundable_amount,
        public readonly int $refundable_tax_amount,
        /**
         * @var int|null
         */
        public readonly ?int $seats = null,
        /**
         * @var string|null
         */
        public readonly ?string $next_payment_attempt_at = null,
        /**
         * @var array<string, string|int|bool|null>|null
         */
        public readonly ?array $custom_field_data = null,
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
        $status = OrderStatus::from(Json::toString(Json::get($data, 'status')));
        $paid = Json::toBool(Json::get($data, 'paid'));
        $subtotal_amount = Json::toInt(Json::get($data, 'subtotal_amount'));
        $discount_amount = Json::toInt(Json::get($data, 'discount_amount'));
        $net_amount = Json::toInt(Json::get($data, 'net_amount'));
        $tax_amount = Json::toInt(Json::get($data, 'tax_amount'));
        $total_amount = Json::toInt(Json::get($data, 'total_amount'));
        $applied_balance_amount = Json::toInt(Json::get($data, 'applied_balance_amount'));
        $due_amount = Json::toInt(Json::get($data, 'due_amount'));
        $refunded_amount = Json::toInt(Json::get($data, 'refunded_amount'));
        $refunded_tax_amount = Json::toInt(Json::get($data, 'refunded_tax_amount'));
        $currency = Json::toString(Json::get($data, 'currency'));
        $billing_reason = OrderBillingReason::from(Json::toString(Json::get($data, 'billing_reason')));
        /** @var string|null $billing_name */
        $billing_name = (Json::get($data, 'billing_name') === null ? null : Json::toString(Json::get($data, 'billing_name')));
        /** @var Address|null $billing_address */
        $billing_address = (Json::get($data, 'billing_address') === null ? null : Address::fromArray(Json::toMap(Json::get($data, 'billing_address'))));
        /** @var string|null $invoice_number */
        $invoice_number = (Json::get($data, 'invoice_number') === null ? null : Json::toString(Json::get($data, 'invoice_number')));
        $is_invoice_generated = Json::toBool(Json::get($data, 'is_invoice_generated'));
        /** @var string|null $receipt_number */
        $receipt_number = (Json::get($data, 'receipt_number') === null ? null : Json::toString(Json::get($data, 'receipt_number')));
        $customer_id = Json::toString(Json::get($data, 'customer_id'));
        /** @var string|null $product_id */
        $product_id = (Json::get($data, 'product_id') === null ? null : Json::toString(Json::get($data, 'product_id')));
        /** @var string|null $discount_id */
        $discount_id = (Json::get($data, 'discount_id') === null ? null : Json::toString(Json::get($data, 'discount_id')));
        /** @var string|null $subscription_id */
        $subscription_id = (Json::get($data, 'subscription_id') === null ? null : Json::toString(Json::get($data, 'subscription_id')));
        /** @var string|null $checkout_id */
        $checkout_id = (Json::get($data, 'checkout_id') === null ? null : Json::toString(Json::get($data, 'checkout_id')));
        /** @var array<string, string|int|float|bool> $metadata */
        $metadata = Json::toMap(Json::get($data, 'metadata'));
        $platform_fee_amount = Json::toInt(Json::get($data, 'platform_fee_amount'));
        /** @var string|null $platform_fee_currency */
        $platform_fee_currency = (Json::get($data, 'platform_fee_currency') === null ? null : Json::toString(Json::get($data, 'platform_fee_currency')));
        $customer = OrderCustomer::fromArray(Json::toMap(Json::get($data, 'customer')));
        /** @var OrderProduct|null $product */
        $product = (Json::get($data, 'product') === null ? null : OrderProduct::fromArray(Json::toMap(Json::get($data, 'product'))));
        /** @var DiscountFixedOnceForeverDurationBase|DiscountFixedRepeatDurationBase|DiscountPercentageOnceForeverDurationBase|DiscountPercentageRepeatDurationBase|null $discount */
        $discount = (Json::get($data, 'discount') === null ? null : Union::resolve(Json::get($data, 'discount'), null, [], [DiscountFixedOnceForeverDurationBase::class, DiscountFixedRepeatDurationBase::class, DiscountPercentageOnceForeverDurationBase::class, DiscountPercentageRepeatDurationBase::class]));
        /** @var OrderSubscription|null $subscription */
        $subscription = (Json::get($data, 'subscription') === null ? null : OrderSubscription::fromArray(Json::toMap(Json::get($data, 'subscription'))));
        /** @var list<OrderItemSchema> $items */
        $items = array_map(static fn (mixed $item0): OrderItemSchema => OrderItemSchema::fromArray(Json::toMap($item0)), Json::toList(Json::get($data, 'items')));
        $description = Json::toString(Json::get($data, 'description'));
        $refundable_amount = Json::toInt(Json::get($data, 'refundable_amount'));
        $refundable_tax_amount = Json::toInt(Json::get($data, 'refundable_tax_amount'));
        /** @var int|null $seats */
        $seats = isset($data['seats']) ? Json::toInt($data['seats']) : null;
        /** @var string|null $next_payment_attempt_at */
        $next_payment_attempt_at = isset($data['next_payment_attempt_at']) ? Json::toString($data['next_payment_attempt_at']) : null;
        /** @var array<string, string|int|bool|null>|null $custom_field_data */
        $custom_field_data = isset($data['custom_field_data']) ? Json::toMap($data['custom_field_data']) : null;

        return new self(
            id: $id,
            created_at: $created_at,
            modified_at: $modified_at,
            status: $status,
            paid: $paid,
            subtotal_amount: $subtotal_amount,
            discount_amount: $discount_amount,
            net_amount: $net_amount,
            tax_amount: $tax_amount,
            total_amount: $total_amount,
            applied_balance_amount: $applied_balance_amount,
            due_amount: $due_amount,
            refunded_amount: $refunded_amount,
            refunded_tax_amount: $refunded_tax_amount,
            currency: $currency,
            billing_reason: $billing_reason,
            billing_name: $billing_name,
            billing_address: $billing_address,
            invoice_number: $invoice_number,
            is_invoice_generated: $is_invoice_generated,
            receipt_number: $receipt_number,
            customer_id: $customer_id,
            product_id: $product_id,
            discount_id: $discount_id,
            subscription_id: $subscription_id,
            checkout_id: $checkout_id,
            metadata: $metadata,
            platform_fee_amount: $platform_fee_amount,
            platform_fee_currency: $platform_fee_currency,
            customer: $customer,
            product: $product,
            discount: $discount,
            subscription: $subscription,
            items: $items,
            description: $description,
            refundable_amount: $refundable_amount,
            refundable_tax_amount: $refundable_tax_amount,
            seats: $seats,
            next_payment_attempt_at: $next_payment_attempt_at,
            custom_field_data: $custom_field_data,
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
        $data['status'] = Json::encode($this->status);
        $data['paid'] = Json::encode($this->paid);
        $data['subtotal_amount'] = Json::encode($this->subtotal_amount);
        $data['discount_amount'] = Json::encode($this->discount_amount);
        $data['net_amount'] = Json::encode($this->net_amount);
        $data['tax_amount'] = Json::encode($this->tax_amount);
        $data['total_amount'] = Json::encode($this->total_amount);
        $data['applied_balance_amount'] = Json::encode($this->applied_balance_amount);
        $data['due_amount'] = Json::encode($this->due_amount);
        $data['refunded_amount'] = Json::encode($this->refunded_amount);
        $data['refunded_tax_amount'] = Json::encode($this->refunded_tax_amount);
        $data['currency'] = Json::encode($this->currency);
        $data['billing_reason'] = Json::encode($this->billing_reason);
        $data['billing_name'] = Json::encode($this->billing_name);
        $data['billing_address'] = Json::encode($this->billing_address);
        $data['invoice_number'] = Json::encode($this->invoice_number);
        $data['is_invoice_generated'] = Json::encode($this->is_invoice_generated);
        $data['receipt_number'] = Json::encode($this->receipt_number);
        $data['customer_id'] = Json::encode($this->customer_id);
        $data['product_id'] = Json::encode($this->product_id);
        $data['discount_id'] = Json::encode($this->discount_id);
        $data['subscription_id'] = Json::encode($this->subscription_id);
        $data['checkout_id'] = Json::encode($this->checkout_id);
        $data['metadata'] = Json::encode($this->metadata);
        $data['platform_fee_amount'] = Json::encode($this->platform_fee_amount);
        $data['platform_fee_currency'] = Json::encode($this->platform_fee_currency);
        $data['customer'] = Json::encode($this->customer);
        $data['product'] = Json::encode($this->product);
        $data['discount'] = Json::encode($this->discount);
        $data['subscription'] = Json::encode($this->subscription);
        $data['items'] = Json::encode($this->items);
        $data['description'] = Json::encode($this->description);
        $data['refundable_amount'] = Json::encode($this->refundable_amount);
        $data['refundable_tax_amount'] = Json::encode($this->refundable_tax_amount);
        if ($this->seats !== null) {
            $data['seats'] = Json::encode($this->seats);
        }
        if ($this->next_payment_attempt_at !== null) {
            $data['next_payment_attempt_at'] = Json::encode($this->next_payment_attempt_at);
        }
        if ($this->custom_field_data !== null) {
            $data['custom_field_data'] = Json::encode($this->custom_field_data);
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