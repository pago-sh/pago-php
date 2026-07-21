<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema to create a new checkout link from a a single product.
 *
 * **Deprecated**: Use `CheckoutLinkCreateProducts` instead.
 */
final class CheckoutLinkCreateProduct implements Model, Deserializable, CheckoutLinkCreate
{
    public function __construct(
        public readonly string $payment_processor,
        public readonly string $product_id,
        /**
         * @var array<string, string|int|float|bool>|null
         */
        public readonly ?array $metadata = null,
        /**
         * @var TrialInterval|null
         */
        public readonly ?TrialInterval $trial_interval = null,
        /**
         * @var int|null
         */
        public readonly ?int $trial_interval_count = null,
        /**
         * @var string|null
         */
        public readonly ?string $label = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $allow_discount_codes = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $require_billing_address = null,
        /**
         * @var string|null
         */
        public readonly ?string $discount_id = null,
        /**
         * @var int|null
         */
        public readonly ?int $seats = null,
        /**
         * @var string|null
         */
        public readonly ?string $success_url = null,
        /**
         * @var string|null
         */
        public readonly ?string $return_url = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $payment_processor = Json::toString(Json::get($data, 'payment_processor'));
        $product_id = Json::toString(Json::get($data, 'product_id'));
        /** @var array<string, string|int|float|bool>|null $metadata */
        $metadata = isset($data['metadata']) ? Json::toMap($data['metadata']) : null;
        /** @var TrialInterval|null $trial_interval */
        $trial_interval = isset($data['trial_interval']) ? TrialInterval::from(Json::toString($data['trial_interval'])) : null;
        /** @var int|null $trial_interval_count */
        $trial_interval_count = isset($data['trial_interval_count']) ? Json::toInt($data['trial_interval_count']) : null;
        /** @var string|null $label */
        $label = isset($data['label']) ? Json::toString($data['label']) : null;
        /** @var bool|null $allow_discount_codes */
        $allow_discount_codes = isset($data['allow_discount_codes']) ? Json::toBool($data['allow_discount_codes']) : null;
        /** @var bool|null $require_billing_address */
        $require_billing_address = isset($data['require_billing_address']) ? Json::toBool($data['require_billing_address']) : null;
        /** @var string|null $discount_id */
        $discount_id = isset($data['discount_id']) ? Json::toString($data['discount_id']) : null;
        /** @var int|null $seats */
        $seats = isset($data['seats']) ? Json::toInt($data['seats']) : null;
        /** @var string|null $success_url */
        $success_url = isset($data['success_url']) ? Json::toString($data['success_url']) : null;
        /** @var string|null $return_url */
        $return_url = isset($data['return_url']) ? Json::toString($data['return_url']) : null;

        return new self(
            payment_processor: $payment_processor,
            product_id: $product_id,
            metadata: $metadata,
            trial_interval: $trial_interval,
            trial_interval_count: $trial_interval_count,
            label: $label,
            allow_discount_codes: $allow_discount_codes,
            require_billing_address: $require_billing_address,
            discount_id: $discount_id,
            seats: $seats,
            success_url: $success_url,
            return_url: $return_url,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['payment_processor'] = Json::encode($this->payment_processor);
        $data['product_id'] = Json::encode($this->product_id);
        if ($this->metadata !== null) {
            $data['metadata'] = Json::encode($this->metadata);
        }
        if ($this->trial_interval !== null) {
            $data['trial_interval'] = Json::encode($this->trial_interval);
        }
        if ($this->trial_interval_count !== null) {
            $data['trial_interval_count'] = Json::encode($this->trial_interval_count);
        }
        if ($this->label !== null) {
            $data['label'] = Json::encode($this->label);
        }
        if ($this->allow_discount_codes !== null) {
            $data['allow_discount_codes'] = Json::encode($this->allow_discount_codes);
        }
        if ($this->require_billing_address !== null) {
            $data['require_billing_address'] = Json::encode($this->require_billing_address);
        }
        if ($this->discount_id !== null) {
            $data['discount_id'] = Json::encode($this->discount_id);
        }
        if ($this->seats !== null) {
            $data['seats'] = Json::encode($this->seats);
        }
        if ($this->success_url !== null) {
            $data['success_url'] = Json::encode($this->success_url);
        }
        if ($this->return_url !== null) {
            $data['return_url'] = Json::encode($this->return_url);
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