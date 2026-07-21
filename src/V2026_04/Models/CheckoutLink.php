<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Checkout link data.
 */
final class CheckoutLink implements Model, Deserializable
{
    public function __construct(
        public readonly string $id,
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        /**
         * @var TrialInterval|null
         */
        public readonly ?TrialInterval $trial_interval,
        /**
         * @var int|null
         */
        public readonly ?int $trial_interval_count,
        /**
         * @var array<string, string|int|float|bool>
         */
        public readonly array $metadata,
        public readonly PaymentProcessor $payment_processor,
        public readonly string $client_secret,
        /**
         * @var string|null
         */
        public readonly ?string $success_url,
        /**
         * @var string|null
         */
        public readonly ?string $return_url,
        /**
         * @var string|null
         */
        public readonly ?string $label,
        public readonly bool $allow_discount_codes,
        public readonly bool $require_billing_address,
        /**
         * @var string|null
         */
        public readonly ?string $discount_id,
        /**
         * @var int|null
         */
        public readonly ?int $seats,
        public readonly string $organization_id,
        /**
         * @var list<CheckoutLinkProduct>
         */
        public readonly array $products,
        public readonly DiscountFixedOnceForeverDurationBase|DiscountFixedRepeatDurationBase|DiscountPercentageOnceForeverDurationBase|DiscountPercentageRepeatDurationBase|null $discount,
        public readonly string $url,
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
        /** @var TrialInterval|null $trial_interval */
        $trial_interval = (Json::get($data, 'trial_interval') === null ? null : TrialInterval::from(Json::toString(Json::get($data, 'trial_interval'))));
        /** @var int|null $trial_interval_count */
        $trial_interval_count = (Json::get($data, 'trial_interval_count') === null ? null : Json::toInt(Json::get($data, 'trial_interval_count')));
        /** @var array<string, string|int|float|bool> $metadata */
        $metadata = Json::toMap(Json::get($data, 'metadata'));
        $payment_processor = PaymentProcessor::from(Json::toString(Json::get($data, 'payment_processor')));
        $client_secret = Json::toString(Json::get($data, 'client_secret'));
        /** @var string|null $success_url */
        $success_url = (Json::get($data, 'success_url') === null ? null : Json::toString(Json::get($data, 'success_url')));
        /** @var string|null $return_url */
        $return_url = (Json::get($data, 'return_url') === null ? null : Json::toString(Json::get($data, 'return_url')));
        /** @var string|null $label */
        $label = (Json::get($data, 'label') === null ? null : Json::toString(Json::get($data, 'label')));
        $allow_discount_codes = Json::toBool(Json::get($data, 'allow_discount_codes'));
        $require_billing_address = Json::toBool(Json::get($data, 'require_billing_address'));
        /** @var string|null $discount_id */
        $discount_id = (Json::get($data, 'discount_id') === null ? null : Json::toString(Json::get($data, 'discount_id')));
        /** @var int|null $seats */
        $seats = (Json::get($data, 'seats') === null ? null : Json::toInt(Json::get($data, 'seats')));
        $organization_id = Json::toString(Json::get($data, 'organization_id'));
        /** @var list<CheckoutLinkProduct> $products */
        $products = array_map(static fn (mixed $item0): CheckoutLinkProduct => CheckoutLinkProduct::fromArray(Json::toMap($item0)), Json::toList(Json::get($data, 'products')));
        /** @var DiscountFixedOnceForeverDurationBase|DiscountFixedRepeatDurationBase|DiscountPercentageOnceForeverDurationBase|DiscountPercentageRepeatDurationBase|null $discount */
        $discount = (Json::get($data, 'discount') === null ? null : Union::resolve(Json::get($data, 'discount'), null, [], [DiscountFixedOnceForeverDurationBase::class, DiscountFixedRepeatDurationBase::class, DiscountPercentageOnceForeverDurationBase::class, DiscountPercentageRepeatDurationBase::class]));
        $url = Json::toString(Json::get($data, 'url'));

        return new self(
            id: $id,
            created_at: $created_at,
            modified_at: $modified_at,
            trial_interval: $trial_interval,
            trial_interval_count: $trial_interval_count,
            metadata: $metadata,
            payment_processor: $payment_processor,
            client_secret: $client_secret,
            success_url: $success_url,
            return_url: $return_url,
            label: $label,
            allow_discount_codes: $allow_discount_codes,
            require_billing_address: $require_billing_address,
            discount_id: $discount_id,
            seats: $seats,
            organization_id: $organization_id,
            products: $products,
            discount: $discount,
            url: $url,
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
        $data['trial_interval'] = Json::encode($this->trial_interval);
        $data['trial_interval_count'] = Json::encode($this->trial_interval_count);
        $data['metadata'] = Json::encode($this->metadata);
        $data['payment_processor'] = Json::encode($this->payment_processor);
        $data['client_secret'] = Json::encode($this->client_secret);
        $data['success_url'] = Json::encode($this->success_url);
        $data['return_url'] = Json::encode($this->return_url);
        $data['label'] = Json::encode($this->label);
        $data['allow_discount_codes'] = Json::encode($this->allow_discount_codes);
        $data['require_billing_address'] = Json::encode($this->require_billing_address);
        $data['discount_id'] = Json::encode($this->discount_id);
        $data['seats'] = Json::encode($this->seats);
        $data['organization_id'] = Json::encode($this->organization_id);
        $data['products'] = Json::encode($this->products);
        $data['discount'] = Json::encode($this->discount);
        $data['url'] = Json::encode($this->url);

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