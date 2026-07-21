<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Create a new checkout session from a list of products.
 * Customers will be able to switch between those products.
 *
 * Metadata set on the checkout will be copied
 * to the resulting order and/or subscription.
 */
final class CheckoutCreate implements Model, Deserializable
{
    public function __construct(
        /**
         * @var list<string>
         */
        public readonly array $products,
        /**
         * @var TrialInterval|null
         */
        public readonly ?TrialInterval $trial_interval = null,
        /**
         * @var int|null
         */
        public readonly ?int $trial_interval_count = null,
        /**
         * @var array<string, string|int|float|bool>|null
         */
        public readonly ?array $metadata = null,
        /**
         * @var array<string, string|int|bool|null>|null
         */
        public readonly ?array $custom_field_data = null,
        /**
         * @var string|null
         */
        public readonly ?string $discount_id = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $allow_discount_codes = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $require_billing_address = null,
        /**
         * @var int|null
         */
        public readonly ?int $amount = null,
        /**
         * @var int|null
         */
        public readonly ?int $seats = null,
        /**
         * @var int|null
         */
        public readonly ?int $min_seats = null,
        /**
         * @var int|null
         */
        public readonly ?int $max_seats = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $allow_trial = null,
        /**
         * @var string|null
         */
        public readonly ?string $customer_id = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $is_business_customer = null,
        /**
         * @var string|null
         */
        public readonly ?string $external_customer_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $customer_name = null,
        /**
         * @var string|null
         */
        public readonly ?string $customer_email = null,
        /**
         * @var string|null
         */
        public readonly ?string $customer_ip_address = null,
        /**
         * @var string|null
         */
        public readonly ?string $customer_billing_name = null,
        /**
         * @var AddressInput|null
         */
        public readonly ?AddressInput $customer_billing_address = null,
        /**
         * @var string|null
         */
        public readonly ?string $customer_tax_id = null,
        /**
         * @var array<string, string|int|float|bool>|null
         */
        public readonly ?array $customer_metadata = null,
        /**
         * @var string|null
         */
        public readonly ?string $subscription_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $success_url = null,
        /**
         * @var string|null
         */
        public readonly ?string $return_url = null,
        /**
         * @var string|null
         */
        public readonly ?string $embed_origin = null,
        /**
         * @var string|null
         */
        public readonly ?string $locale = null,
        /**
         * @var PresentmentCurrency|null
         */
        public readonly ?PresentmentCurrency $currency = null,
        /**
         * @var array<string, list<ProductPriceFixedCreate|ProductPriceCustomCreate|ProductPriceSeatBasedCreate|ProductPriceMeteredUnitCreate>>|null
         */
        public readonly ?array $prices = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var list<string> $products */
        $products = array_map(static fn (mixed $item0): string => Json::toString($item0), Json::toList(Json::get($data, 'products')));
        /** @var TrialInterval|null $trial_interval */
        $trial_interval = isset($data['trial_interval']) ? TrialInterval::from(Json::toString($data['trial_interval'])) : null;
        /** @var int|null $trial_interval_count */
        $trial_interval_count = isset($data['trial_interval_count']) ? Json::toInt($data['trial_interval_count']) : null;
        /** @var array<string, string|int|float|bool>|null $metadata */
        $metadata = isset($data['metadata']) ? Json::toMap($data['metadata']) : null;
        /** @var array<string, string|int|bool|null>|null $custom_field_data */
        $custom_field_data = isset($data['custom_field_data']) ? Json::toMap($data['custom_field_data']) : null;
        /** @var string|null $discount_id */
        $discount_id = isset($data['discount_id']) ? Json::toString($data['discount_id']) : null;
        /** @var bool|null $allow_discount_codes */
        $allow_discount_codes = isset($data['allow_discount_codes']) ? Json::toBool($data['allow_discount_codes']) : null;
        /** @var bool|null $require_billing_address */
        $require_billing_address = isset($data['require_billing_address']) ? Json::toBool($data['require_billing_address']) : null;
        /** @var int|null $amount */
        $amount = isset($data['amount']) ? Json::toInt($data['amount']) : null;
        /** @var int|null $seats */
        $seats = isset($data['seats']) ? Json::toInt($data['seats']) : null;
        /** @var int|null $min_seats */
        $min_seats = isset($data['min_seats']) ? Json::toInt($data['min_seats']) : null;
        /** @var int|null $max_seats */
        $max_seats = isset($data['max_seats']) ? Json::toInt($data['max_seats']) : null;
        /** @var bool|null $allow_trial */
        $allow_trial = isset($data['allow_trial']) ? Json::toBool($data['allow_trial']) : null;
        /** @var string|null $customer_id */
        $customer_id = isset($data['customer_id']) ? Json::toString($data['customer_id']) : null;
        /** @var bool|null $is_business_customer */
        $is_business_customer = isset($data['is_business_customer']) ? Json::toBool($data['is_business_customer']) : null;
        /** @var string|null $external_customer_id */
        $external_customer_id = isset($data['external_customer_id']) ? Json::toString($data['external_customer_id']) : null;
        /** @var string|null $customer_name */
        $customer_name = isset($data['customer_name']) ? Json::toString($data['customer_name']) : null;
        /** @var string|null $customer_email */
        $customer_email = isset($data['customer_email']) ? Json::toString($data['customer_email']) : null;
        /** @var string|null $customer_ip_address */
        $customer_ip_address = isset($data['customer_ip_address']) ? Json::toString($data['customer_ip_address']) : null;
        /** @var string|null $customer_billing_name */
        $customer_billing_name = isset($data['customer_billing_name']) ? Json::toString($data['customer_billing_name']) : null;
        /** @var AddressInput|null $customer_billing_address */
        $customer_billing_address = isset($data['customer_billing_address']) ? AddressInput::fromArray(Json::toMap($data['customer_billing_address'])) : null;
        /** @var string|null $customer_tax_id */
        $customer_tax_id = isset($data['customer_tax_id']) ? Json::toString($data['customer_tax_id']) : null;
        /** @var array<string, string|int|float|bool>|null $customer_metadata */
        $customer_metadata = isset($data['customer_metadata']) ? Json::toMap($data['customer_metadata']) : null;
        /** @var string|null $subscription_id */
        $subscription_id = isset($data['subscription_id']) ? Json::toString($data['subscription_id']) : null;
        /** @var string|null $success_url */
        $success_url = isset($data['success_url']) ? Json::toString($data['success_url']) : null;
        /** @var string|null $return_url */
        $return_url = isset($data['return_url']) ? Json::toString($data['return_url']) : null;
        /** @var string|null $embed_origin */
        $embed_origin = isset($data['embed_origin']) ? Json::toString($data['embed_origin']) : null;
        /** @var string|null $locale */
        $locale = isset($data['locale']) ? Json::toString($data['locale']) : null;
        /** @var PresentmentCurrency|null $currency */
        $currency = isset($data['currency']) ? PresentmentCurrency::from(Json::toString($data['currency'])) : null;
        /** @var array<string, list<ProductPriceFixedCreate|ProductPriceCustomCreate|ProductPriceSeatBasedCreate|ProductPriceMeteredUnitCreate>>|null $prices */
        $prices = isset($data['prices']) ? array_map(static fn (mixed $item0): mixed => array_map(static fn (mixed $item1): mixed => Union::resolve($item1, 'amount_type', ['custom' => ProductPriceCustomCreate::class, 'fixed' => ProductPriceFixedCreate::class, 'metered_unit' => ProductPriceMeteredUnitCreate::class, 'seat_based' => ProductPriceSeatBasedCreate::class], [ProductPriceFixedCreate::class, ProductPriceCustomCreate::class, ProductPriceSeatBasedCreate::class, ProductPriceMeteredUnitCreate::class]), Json::toList($item0)), Json::toMap($data['prices'])) : null;

        return new self(
            products: $products,
            trial_interval: $trial_interval,
            trial_interval_count: $trial_interval_count,
            metadata: $metadata,
            custom_field_data: $custom_field_data,
            discount_id: $discount_id,
            allow_discount_codes: $allow_discount_codes,
            require_billing_address: $require_billing_address,
            amount: $amount,
            seats: $seats,
            min_seats: $min_seats,
            max_seats: $max_seats,
            allow_trial: $allow_trial,
            customer_id: $customer_id,
            is_business_customer: $is_business_customer,
            external_customer_id: $external_customer_id,
            customer_name: $customer_name,
            customer_email: $customer_email,
            customer_ip_address: $customer_ip_address,
            customer_billing_name: $customer_billing_name,
            customer_billing_address: $customer_billing_address,
            customer_tax_id: $customer_tax_id,
            customer_metadata: $customer_metadata,
            subscription_id: $subscription_id,
            success_url: $success_url,
            return_url: $return_url,
            embed_origin: $embed_origin,
            locale: $locale,
            currency: $currency,
            prices: $prices,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['products'] = Json::encode($this->products);
        if ($this->trial_interval !== null) {
            $data['trial_interval'] = Json::encode($this->trial_interval);
        }
        if ($this->trial_interval_count !== null) {
            $data['trial_interval_count'] = Json::encode($this->trial_interval_count);
        }
        if ($this->metadata !== null) {
            $data['metadata'] = Json::encode($this->metadata);
        }
        if ($this->custom_field_data !== null) {
            $data['custom_field_data'] = Json::encode($this->custom_field_data);
        }
        if ($this->discount_id !== null) {
            $data['discount_id'] = Json::encode($this->discount_id);
        }
        if ($this->allow_discount_codes !== null) {
            $data['allow_discount_codes'] = Json::encode($this->allow_discount_codes);
        }
        if ($this->require_billing_address !== null) {
            $data['require_billing_address'] = Json::encode($this->require_billing_address);
        }
        if ($this->amount !== null) {
            $data['amount'] = Json::encode($this->amount);
        }
        if ($this->seats !== null) {
            $data['seats'] = Json::encode($this->seats);
        }
        if ($this->min_seats !== null) {
            $data['min_seats'] = Json::encode($this->min_seats);
        }
        if ($this->max_seats !== null) {
            $data['max_seats'] = Json::encode($this->max_seats);
        }
        if ($this->allow_trial !== null) {
            $data['allow_trial'] = Json::encode($this->allow_trial);
        }
        if ($this->customer_id !== null) {
            $data['customer_id'] = Json::encode($this->customer_id);
        }
        if ($this->is_business_customer !== null) {
            $data['is_business_customer'] = Json::encode($this->is_business_customer);
        }
        if ($this->external_customer_id !== null) {
            $data['external_customer_id'] = Json::encode($this->external_customer_id);
        }
        if ($this->customer_name !== null) {
            $data['customer_name'] = Json::encode($this->customer_name);
        }
        if ($this->customer_email !== null) {
            $data['customer_email'] = Json::encode($this->customer_email);
        }
        if ($this->customer_ip_address !== null) {
            $data['customer_ip_address'] = Json::encode($this->customer_ip_address);
        }
        if ($this->customer_billing_name !== null) {
            $data['customer_billing_name'] = Json::encode($this->customer_billing_name);
        }
        if ($this->customer_billing_address !== null) {
            $data['customer_billing_address'] = Json::encode($this->customer_billing_address);
        }
        if ($this->customer_tax_id !== null) {
            $data['customer_tax_id'] = Json::encode($this->customer_tax_id);
        }
        if ($this->customer_metadata !== null) {
            $data['customer_metadata'] = Json::encode($this->customer_metadata);
        }
        if ($this->subscription_id !== null) {
            $data['subscription_id'] = Json::encode($this->subscription_id);
        }
        if ($this->success_url !== null) {
            $data['success_url'] = Json::encode($this->success_url);
        }
        if ($this->return_url !== null) {
            $data['return_url'] = Json::encode($this->return_url);
        }
        if ($this->embed_origin !== null) {
            $data['embed_origin'] = Json::encode($this->embed_origin);
        }
        if ($this->locale !== null) {
            $data['locale'] = Json::encode($this->locale);
        }
        if ($this->currency !== null) {
            $data['currency'] = Json::encode($this->currency);
        }
        if ($this->prices !== null) {
            $data['prices'] = Json::encode($this->prices);
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