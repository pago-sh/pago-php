<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Checkout session data retrieved using the client secret after confirmation.
 *
 * It contains a customer session token to retrieve order information
 * right after the checkout.
 */
final class CheckoutPublicConfirmed implements Model, Deserializable
{
    public function __construct(
        public readonly string $id,
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly PaymentProcessor $payment_processor,
        public readonly string $status,
        public readonly string $client_secret,
        public readonly string $url,
        public readonly string $expires_at,
        public readonly string $success_url,
        /**
         * @var string|null
         */
        public readonly ?string $return_url,
        /**
         * @var string|null
         */
        public readonly ?string $embed_origin,
        public readonly int $amount,
        public readonly int $discount_amount,
        public readonly int $net_amount,
        /**
         * @var int|null
         */
        public readonly ?int $tax_amount,
        /**
         * @var TaxBehavior|null
         */
        public readonly ?TaxBehavior $tax_behavior,
        public readonly int $total_amount,
        public readonly string $currency,
        /**
         * @var bool|null
         */
        public readonly ?bool $allow_trial,
        /**
         * @var TrialInterval|null
         */
        public readonly ?TrialInterval $active_trial_interval,
        /**
         * @var int|null
         */
        public readonly ?int $active_trial_interval_count,
        /**
         * @var string|null
         */
        public readonly ?string $trial_end,
        public readonly string $organization_id,
        /**
         * @var string|null
         */
        public readonly ?string $product_id,
        /**
         * @deprecated
         * @var string|null
         */
        public readonly ?string $product_price_id,
        /**
         * @var string|null
         */
        public readonly ?string $discount_id,
        public readonly bool $allow_discount_codes,
        public readonly bool $require_billing_address,
        public readonly bool $is_discount_applicable,
        public readonly bool $is_free_product_price,
        public readonly bool $is_payment_required,
        public readonly bool $is_payment_setup_required,
        public readonly bool $is_payment_form_required,
        /**
         * @var string|null
         */
        public readonly ?string $customer_id,
        public readonly bool $is_business_customer,
        /**
         * @var string|null
         */
        public readonly ?string $customer_name,
        /**
         * @var string|null
         */
        public readonly ?string $customer_email,
        /**
         * @var string|null
         */
        public readonly ?string $customer_ip_address,
        /**
         * @var string|null
         */
        public readonly ?string $customer_billing_name,
        /**
         * @var Address|null
         */
        public readonly ?Address $customer_billing_address,
        /**
         * @var string|null
         */
        public readonly ?string $customer_tax_id,
        /**
         * @var array<string, string>
         */
        public readonly array $payment_processor_metadata,
        public readonly CheckoutBillingAddressFields $billing_address_fields,
        /**
         * @var list<CheckoutProduct>
         */
        public readonly array $products,
        /**
         * @var CheckoutProduct|null
         */
        public readonly ?CheckoutProduct $product,
        /**
         * @deprecated
         */
        public readonly LegacyRecurringProductPrice|ProductPrice|null $product_price,
        /**
         * @var array<string, list<LegacyRecurringProductPrice|ProductPrice>>|null
         */
        public readonly ?array $prices,
        public readonly CheckoutDiscountFixedOnceForeverDuration|CheckoutDiscountFixedRepeatDuration|CheckoutDiscountPercentageOnceForeverDuration|CheckoutDiscountPercentageRepeatDuration|null $discount,
        public readonly CheckoutOrganization $organization,
        /**
         * @var list<AttachedCustomField>|null
         */
        public readonly ?array $attached_custom_fields,
        /**
         * @var string|null
         */
        public readonly ?string $customer_session_token,
        /**
         * @var array<string, string|int|bool|null>|null
         */
        public readonly ?array $custom_field_data = null,
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
         * @var string|null
         */
        public readonly ?string $locale = null,
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
        $payment_processor = PaymentProcessor::from(Json::toString(Json::get($data, 'payment_processor')));
        $status = Json::toString(Json::get($data, 'status'));
        $client_secret = Json::toString(Json::get($data, 'client_secret'));
        $url = Json::toString(Json::get($data, 'url'));
        $expires_at = Json::toString(Json::get($data, 'expires_at'));
        $success_url = Json::toString(Json::get($data, 'success_url'));
        /** @var string|null $return_url */
        $return_url = (Json::get($data, 'return_url') === null ? null : Json::toString(Json::get($data, 'return_url')));
        /** @var string|null $embed_origin */
        $embed_origin = (Json::get($data, 'embed_origin') === null ? null : Json::toString(Json::get($data, 'embed_origin')));
        $amount = Json::toInt(Json::get($data, 'amount'));
        $discount_amount = Json::toInt(Json::get($data, 'discount_amount'));
        $net_amount = Json::toInt(Json::get($data, 'net_amount'));
        /** @var int|null $tax_amount */
        $tax_amount = (Json::get($data, 'tax_amount') === null ? null : Json::toInt(Json::get($data, 'tax_amount')));
        /** @var TaxBehavior|null $tax_behavior */
        $tax_behavior = (Json::get($data, 'tax_behavior') === null ? null : TaxBehavior::from(Json::toString(Json::get($data, 'tax_behavior'))));
        $total_amount = Json::toInt(Json::get($data, 'total_amount'));
        $currency = Json::toString(Json::get($data, 'currency'));
        /** @var bool|null $allow_trial */
        $allow_trial = (Json::get($data, 'allow_trial') === null ? null : Json::toBool(Json::get($data, 'allow_trial')));
        /** @var TrialInterval|null $active_trial_interval */
        $active_trial_interval = (Json::get($data, 'active_trial_interval') === null ? null : TrialInterval::from(Json::toString(Json::get($data, 'active_trial_interval'))));
        /** @var int|null $active_trial_interval_count */
        $active_trial_interval_count = (Json::get($data, 'active_trial_interval_count') === null ? null : Json::toInt(Json::get($data, 'active_trial_interval_count')));
        /** @var string|null $trial_end */
        $trial_end = (Json::get($data, 'trial_end') === null ? null : Json::toString(Json::get($data, 'trial_end')));
        $organization_id = Json::toString(Json::get($data, 'organization_id'));
        /** @var string|null $product_id */
        $product_id = (Json::get($data, 'product_id') === null ? null : Json::toString(Json::get($data, 'product_id')));
        /** @var string|null $product_price_id */
        $product_price_id = (Json::get($data, 'product_price_id') === null ? null : Json::toString(Json::get($data, 'product_price_id')));
        /** @var string|null $discount_id */
        $discount_id = (Json::get($data, 'discount_id') === null ? null : Json::toString(Json::get($data, 'discount_id')));
        $allow_discount_codes = Json::toBool(Json::get($data, 'allow_discount_codes'));
        $require_billing_address = Json::toBool(Json::get($data, 'require_billing_address'));
        $is_discount_applicable = Json::toBool(Json::get($data, 'is_discount_applicable'));
        $is_free_product_price = Json::toBool(Json::get($data, 'is_free_product_price'));
        $is_payment_required = Json::toBool(Json::get($data, 'is_payment_required'));
        $is_payment_setup_required = Json::toBool(Json::get($data, 'is_payment_setup_required'));
        $is_payment_form_required = Json::toBool(Json::get($data, 'is_payment_form_required'));
        /** @var string|null $customer_id */
        $customer_id = (Json::get($data, 'customer_id') === null ? null : Json::toString(Json::get($data, 'customer_id')));
        $is_business_customer = Json::toBool(Json::get($data, 'is_business_customer'));
        /** @var string|null $customer_name */
        $customer_name = (Json::get($data, 'customer_name') === null ? null : Json::toString(Json::get($data, 'customer_name')));
        /** @var string|null $customer_email */
        $customer_email = (Json::get($data, 'customer_email') === null ? null : Json::toString(Json::get($data, 'customer_email')));
        /** @var string|null $customer_ip_address */
        $customer_ip_address = (Json::get($data, 'customer_ip_address') === null ? null : Json::toString(Json::get($data, 'customer_ip_address')));
        /** @var string|null $customer_billing_name */
        $customer_billing_name = (Json::get($data, 'customer_billing_name') === null ? null : Json::toString(Json::get($data, 'customer_billing_name')));
        /** @var Address|null $customer_billing_address */
        $customer_billing_address = (Json::get($data, 'customer_billing_address') === null ? null : Address::fromArray(Json::toMap(Json::get($data, 'customer_billing_address'))));
        /** @var string|null $customer_tax_id */
        $customer_tax_id = (Json::get($data, 'customer_tax_id') === null ? null : Json::toString(Json::get($data, 'customer_tax_id')));
        /** @var array<string, string> $payment_processor_metadata */
        $payment_processor_metadata = array_map(static fn (mixed $item0): string => Json::toString($item0), Json::toMap(Json::get($data, 'payment_processor_metadata')));
        $billing_address_fields = CheckoutBillingAddressFields::fromArray(Json::toMap(Json::get($data, 'billing_address_fields')));
        /** @var list<CheckoutProduct> $products */
        $products = array_map(static fn (mixed $item0): CheckoutProduct => CheckoutProduct::fromArray(Json::toMap($item0)), Json::toList(Json::get($data, 'products')));
        /** @var CheckoutProduct|null $product */
        $product = (Json::get($data, 'product') === null ? null : CheckoutProduct::fromArray(Json::toMap(Json::get($data, 'product'))));
        /** @var LegacyRecurringProductPrice|ProductPrice|null $product_price */
        $product_price = (Json::get($data, 'product_price') === null ? null : Union::resolve(Json::get($data, 'product_price'), null, [], [LegacyRecurringProductPriceFactory::class, ProductPriceFactory::class]));
        /** @var array<string, list<LegacyRecurringProductPrice|ProductPrice>>|null $prices */
        $prices = (Json::get($data, 'prices') === null ? null : array_map(static fn (mixed $item0): mixed => array_map(static fn (mixed $item1): mixed => Union::resolve($item1, null, [], [LegacyRecurringProductPriceFactory::class, ProductPriceFactory::class]), Json::toList($item0)), Json::toMap(Json::get($data, 'prices'))));
        /** @var CheckoutDiscountFixedOnceForeverDuration|CheckoutDiscountFixedRepeatDuration|CheckoutDiscountPercentageOnceForeverDuration|CheckoutDiscountPercentageRepeatDuration|null $discount */
        $discount = (Json::get($data, 'discount') === null ? null : Union::resolve(Json::get($data, 'discount'), null, [], [CheckoutDiscountFixedOnceForeverDuration::class, CheckoutDiscountFixedRepeatDuration::class, CheckoutDiscountPercentageOnceForeverDuration::class, CheckoutDiscountPercentageRepeatDuration::class]));
        $organization = CheckoutOrganization::fromArray(Json::toMap(Json::get($data, 'organization')));
        /** @var list<AttachedCustomField>|null $attached_custom_fields */
        $attached_custom_fields = (Json::get($data, 'attached_custom_fields') === null ? null : array_map(static fn (mixed $item0): AttachedCustomField => AttachedCustomField::fromArray(Json::toMap($item0)), Json::toList(Json::get($data, 'attached_custom_fields'))));
        /** @var string|null $customer_session_token */
        $customer_session_token = (Json::get($data, 'customer_session_token') === null ? null : Json::toString(Json::get($data, 'customer_session_token')));
        /** @var array<string, string|int|bool|null>|null $custom_field_data */
        $custom_field_data = isset($data['custom_field_data']) ? Json::toMap($data['custom_field_data']) : null;
        /** @var int|null $seats */
        $seats = isset($data['seats']) ? Json::toInt($data['seats']) : null;
        /** @var int|null $min_seats */
        $min_seats = isset($data['min_seats']) ? Json::toInt($data['min_seats']) : null;
        /** @var int|null $max_seats */
        $max_seats = isset($data['max_seats']) ? Json::toInt($data['max_seats']) : null;
        /** @var string|null $locale */
        $locale = isset($data['locale']) ? Json::toString($data['locale']) : null;

        return new self(
            id: $id,
            created_at: $created_at,
            modified_at: $modified_at,
            payment_processor: $payment_processor,
            status: $status,
            client_secret: $client_secret,
            url: $url,
            expires_at: $expires_at,
            success_url: $success_url,
            return_url: $return_url,
            embed_origin: $embed_origin,
            amount: $amount,
            discount_amount: $discount_amount,
            net_amount: $net_amount,
            tax_amount: $tax_amount,
            tax_behavior: $tax_behavior,
            total_amount: $total_amount,
            currency: $currency,
            allow_trial: $allow_trial,
            active_trial_interval: $active_trial_interval,
            active_trial_interval_count: $active_trial_interval_count,
            trial_end: $trial_end,
            organization_id: $organization_id,
            product_id: $product_id,
            product_price_id: $product_price_id,
            discount_id: $discount_id,
            allow_discount_codes: $allow_discount_codes,
            require_billing_address: $require_billing_address,
            is_discount_applicable: $is_discount_applicable,
            is_free_product_price: $is_free_product_price,
            is_payment_required: $is_payment_required,
            is_payment_setup_required: $is_payment_setup_required,
            is_payment_form_required: $is_payment_form_required,
            customer_id: $customer_id,
            is_business_customer: $is_business_customer,
            customer_name: $customer_name,
            customer_email: $customer_email,
            customer_ip_address: $customer_ip_address,
            customer_billing_name: $customer_billing_name,
            customer_billing_address: $customer_billing_address,
            customer_tax_id: $customer_tax_id,
            payment_processor_metadata: $payment_processor_metadata,
            billing_address_fields: $billing_address_fields,
            products: $products,
            product: $product,
            product_price: $product_price,
            prices: $prices,
            discount: $discount,
            organization: $organization,
            attached_custom_fields: $attached_custom_fields,
            customer_session_token: $customer_session_token,
            custom_field_data: $custom_field_data,
            seats: $seats,
            min_seats: $min_seats,
            max_seats: $max_seats,
            locale: $locale,
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
        $data['payment_processor'] = Json::encode($this->payment_processor);
        $data['status'] = Json::encode($this->status);
        $data['client_secret'] = Json::encode($this->client_secret);
        $data['url'] = Json::encode($this->url);
        $data['expires_at'] = Json::encode($this->expires_at);
        $data['success_url'] = Json::encode($this->success_url);
        $data['return_url'] = Json::encode($this->return_url);
        $data['embed_origin'] = Json::encode($this->embed_origin);
        $data['amount'] = Json::encode($this->amount);
        $data['discount_amount'] = Json::encode($this->discount_amount);
        $data['net_amount'] = Json::encode($this->net_amount);
        $data['tax_amount'] = Json::encode($this->tax_amount);
        $data['tax_behavior'] = Json::encode($this->tax_behavior);
        $data['total_amount'] = Json::encode($this->total_amount);
        $data['currency'] = Json::encode($this->currency);
        $data['allow_trial'] = Json::encode($this->allow_trial);
        $data['active_trial_interval'] = Json::encode($this->active_trial_interval);
        $data['active_trial_interval_count'] = Json::encode($this->active_trial_interval_count);
        $data['trial_end'] = Json::encode($this->trial_end);
        $data['organization_id'] = Json::encode($this->organization_id);
        $data['product_id'] = Json::encode($this->product_id);
        $data['product_price_id'] = Json::encode($this->product_price_id);
        $data['discount_id'] = Json::encode($this->discount_id);
        $data['allow_discount_codes'] = Json::encode($this->allow_discount_codes);
        $data['require_billing_address'] = Json::encode($this->require_billing_address);
        $data['is_discount_applicable'] = Json::encode($this->is_discount_applicable);
        $data['is_free_product_price'] = Json::encode($this->is_free_product_price);
        $data['is_payment_required'] = Json::encode($this->is_payment_required);
        $data['is_payment_setup_required'] = Json::encode($this->is_payment_setup_required);
        $data['is_payment_form_required'] = Json::encode($this->is_payment_form_required);
        $data['customer_id'] = Json::encode($this->customer_id);
        $data['is_business_customer'] = Json::encode($this->is_business_customer);
        $data['customer_name'] = Json::encode($this->customer_name);
        $data['customer_email'] = Json::encode($this->customer_email);
        $data['customer_ip_address'] = Json::encode($this->customer_ip_address);
        $data['customer_billing_name'] = Json::encode($this->customer_billing_name);
        $data['customer_billing_address'] = Json::encode($this->customer_billing_address);
        $data['customer_tax_id'] = Json::encode($this->customer_tax_id);
        $data['payment_processor_metadata'] = Json::encode($this->payment_processor_metadata);
        $data['billing_address_fields'] = Json::encode($this->billing_address_fields);
        $data['products'] = Json::encode($this->products);
        $data['product'] = Json::encode($this->product);
        $data['product_price'] = Json::encode($this->product_price);
        $data['prices'] = Json::encode($this->prices);
        $data['discount'] = Json::encode($this->discount);
        $data['organization'] = Json::encode($this->organization);
        $data['attached_custom_fields'] = Json::encode($this->attached_custom_fields);
        $data['customer_session_token'] = Json::encode($this->customer_session_token);
        if ($this->custom_field_data !== null) {
            $data['custom_field_data'] = Json::encode($this->custom_field_data);
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
        if ($this->locale !== null) {
            $data['locale'] = Json::encode($this->locale);
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