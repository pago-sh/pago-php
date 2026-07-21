<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Confirm a checkout session using a Stripe confirmation token.
 */
final class CheckoutConfirmStripe implements Model, Deserializable
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
         * @var string|null
         */
        public readonly ?string $discount_code = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $allow_trial = null,
        /**
         * @var string|null
         */
        public readonly ?string $confirmation_token_id = null,
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
        /** @var string|null $discount_code */
        $discount_code = isset($data['discount_code']) ? Json::toString($data['discount_code']) : null;
        /** @var bool|null $allow_trial */
        $allow_trial = isset($data['allow_trial']) ? Json::toBool($data['allow_trial']) : null;
        /** @var string|null $confirmation_token_id */
        $confirmation_token_id = isset($data['confirmation_token_id']) ? Json::toString($data['confirmation_token_id']) : null;

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
            discount_code: $discount_code,
            allow_trial: $allow_trial,
            confirmation_token_id: $confirmation_token_id,
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
        if ($this->discount_code !== null) {
            $data['discount_code'] = Json::encode($this->discount_code);
        }
        if ($this->allow_trial !== null) {
            $data['allow_trial'] = Json::encode($this->allow_trial);
        }
        if ($this->confirmation_token_id !== null) {
            $data['confirmation_token_id'] = Json::encode($this->confirmation_token_id);
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