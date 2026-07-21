<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Update an existing checkout session using an access token.
 */
final class CheckoutUpdate implements Model, Deserializable
{
    public function __construct(
        /**
         * @var array<string, string|int|bool|null>|null
         */
        public readonly ?array $custom_field_data = null,
        /**
         * @var string|null
         */
        public readonly ?string $product_id = null,
        /**
         * @deprecated
         * @var string|null
         */
        public readonly ?string $product_price_id = null,
        /**
         * @var int|null
         */
        public readonly ?int $amount = null,
        /**
         * @var int|null
         */
        public readonly ?int $seats = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $is_business_customer = null,
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
         * @var string|null
         */
        public readonly ?string $locale = null,
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
         * @var PresentmentCurrency|null
         */
        public readonly ?PresentmentCurrency $currency = null,
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
         * @var bool|null
         */
        public readonly ?bool $allow_trial = null,
        /**
         * @var string|null
         */
        public readonly ?string $customer_ip_address = null,
        /**
         * @var array<string, string|int|float|bool>|null
         */
        public readonly ?array $customer_metadata = null,
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
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var array<string, string|int|bool|null>|null $custom_field_data */
        $custom_field_data = isset($data['custom_field_data']) ? Json::toMap($data['custom_field_data']) : null;
        /** @var string|null $product_id */
        $product_id = isset($data['product_id']) ? Json::toString($data['product_id']) : null;
        /** @var string|null $product_price_id */
        $product_price_id = isset($data['product_price_id']) ? Json::toString($data['product_price_id']) : null;
        /** @var int|null $amount */
        $amount = isset($data['amount']) ? Json::toInt($data['amount']) : null;
        /** @var int|null $seats */
        $seats = isset($data['seats']) ? Json::toInt($data['seats']) : null;
        /** @var bool|null $is_business_customer */
        $is_business_customer = isset($data['is_business_customer']) ? Json::toBool($data['is_business_customer']) : null;
        /** @var string|null $customer_name */
        $customer_name = isset($data['customer_name']) ? Json::toString($data['customer_name']) : null;
        /** @var string|null $customer_email */
        $customer_email = isset($data['customer_email']) ? Json::toString($data['customer_email']) : null;
        /** @var string|null $customer_billing_name */
        $customer_billing_name = isset($data['customer_billing_name']) ? Json::toString($data['customer_billing_name']) : null;
        /** @var AddressInput|null $customer_billing_address */
        $customer_billing_address = isset($data['customer_billing_address']) ? AddressInput::fromArray(Json::toMap($data['customer_billing_address'])) : null;
        /** @var string|null $customer_tax_id */
        $customer_tax_id = isset($data['customer_tax_id']) ? Json::toString($data['customer_tax_id']) : null;
        /** @var string|null $locale */
        $locale = isset($data['locale']) ? Json::toString($data['locale']) : null;
        /** @var TrialInterval|null $trial_interval */
        $trial_interval = isset($data['trial_interval']) ? TrialInterval::from(Json::toString($data['trial_interval'])) : null;
        /** @var int|null $trial_interval_count */
        $trial_interval_count = isset($data['trial_interval_count']) ? Json::toInt($data['trial_interval_count']) : null;
        /** @var array<string, string|int|float|bool>|null $metadata */
        $metadata = isset($data['metadata']) ? Json::toMap($data['metadata']) : null;
        /** @var PresentmentCurrency|null $currency */
        $currency = isset($data['currency']) ? PresentmentCurrency::from(Json::toString($data['currency'])) : null;
        /** @var string|null $discount_id */
        $discount_id = isset($data['discount_id']) ? Json::toString($data['discount_id']) : null;
        /** @var bool|null $allow_discount_codes */
        $allow_discount_codes = isset($data['allow_discount_codes']) ? Json::toBool($data['allow_discount_codes']) : null;
        /** @var bool|null $require_billing_address */
        $require_billing_address = isset($data['require_billing_address']) ? Json::toBool($data['require_billing_address']) : null;
        /** @var bool|null $allow_trial */
        $allow_trial = isset($data['allow_trial']) ? Json::toBool($data['allow_trial']) : null;
        /** @var string|null $customer_ip_address */
        $customer_ip_address = isset($data['customer_ip_address']) ? Json::toString($data['customer_ip_address']) : null;
        /** @var array<string, string|int|float|bool>|null $customer_metadata */
        $customer_metadata = isset($data['customer_metadata']) ? Json::toMap($data['customer_metadata']) : null;
        /** @var string|null $success_url */
        $success_url = isset($data['success_url']) ? Json::toString($data['success_url']) : null;
        /** @var string|null $return_url */
        $return_url = isset($data['return_url']) ? Json::toString($data['return_url']) : null;
        /** @var string|null $embed_origin */
        $embed_origin = isset($data['embed_origin']) ? Json::toString($data['embed_origin']) : null;

        return new self(
            custom_field_data: $custom_field_data,
            product_id: $product_id,
            product_price_id: $product_price_id,
            amount: $amount,
            seats: $seats,
            is_business_customer: $is_business_customer,
            customer_name: $customer_name,
            customer_email: $customer_email,
            customer_billing_name: $customer_billing_name,
            customer_billing_address: $customer_billing_address,
            customer_tax_id: $customer_tax_id,
            locale: $locale,
            trial_interval: $trial_interval,
            trial_interval_count: $trial_interval_count,
            metadata: $metadata,
            currency: $currency,
            discount_id: $discount_id,
            allow_discount_codes: $allow_discount_codes,
            require_billing_address: $require_billing_address,
            allow_trial: $allow_trial,
            customer_ip_address: $customer_ip_address,
            customer_metadata: $customer_metadata,
            success_url: $success_url,
            return_url: $return_url,
            embed_origin: $embed_origin,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->custom_field_data !== null) {
            $data['custom_field_data'] = Json::encode($this->custom_field_data);
        }
        if ($this->product_id !== null) {
            $data['product_id'] = Json::encode($this->product_id);
        }
        if ($this->product_price_id !== null) {
            $data['product_price_id'] = Json::encode($this->product_price_id);
        }
        if ($this->amount !== null) {
            $data['amount'] = Json::encode($this->amount);
        }
        if ($this->seats !== null) {
            $data['seats'] = Json::encode($this->seats);
        }
        if ($this->is_business_customer !== null) {
            $data['is_business_customer'] = Json::encode($this->is_business_customer);
        }
        if ($this->customer_name !== null) {
            $data['customer_name'] = Json::encode($this->customer_name);
        }
        if ($this->customer_email !== null) {
            $data['customer_email'] = Json::encode($this->customer_email);
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
        if ($this->locale !== null) {
            $data['locale'] = Json::encode($this->locale);
        }
        if ($this->trial_interval !== null) {
            $data['trial_interval'] = Json::encode($this->trial_interval);
        }
        if ($this->trial_interval_count !== null) {
            $data['trial_interval_count'] = Json::encode($this->trial_interval_count);
        }
        if ($this->metadata !== null) {
            $data['metadata'] = Json::encode($this->metadata);
        }
        if ($this->currency !== null) {
            $data['currency'] = Json::encode($this->currency);
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
        if ($this->allow_trial !== null) {
            $data['allow_trial'] = Json::encode($this->allow_trial);
        }
        if ($this->customer_ip_address !== null) {
            $data['customer_ip_address'] = Json::encode($this->customer_ip_address);
        }
        if ($this->customer_metadata !== null) {
            $data['customer_metadata'] = Json::encode($this->customer_metadata);
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