<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CheckoutBillingAddressFields
 */
final class CheckoutBillingAddressFields implements Model, Deserializable
{
    public function __construct(
        public readonly BillingAddressFieldMode $country,
        public readonly BillingAddressFieldMode $state,
        public readonly BillingAddressFieldMode $city,
        public readonly BillingAddressFieldMode $postal_code,
        public readonly BillingAddressFieldMode $line1,
        public readonly BillingAddressFieldMode $line2,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $country = BillingAddressFieldMode::from(Json::toString(Json::get($data, 'country')));
        $state = BillingAddressFieldMode::from(Json::toString(Json::get($data, 'state')));
        $city = BillingAddressFieldMode::from(Json::toString(Json::get($data, 'city')));
        $postal_code = BillingAddressFieldMode::from(Json::toString(Json::get($data, 'postal_code')));
        $line1 = BillingAddressFieldMode::from(Json::toString(Json::get($data, 'line1')));
        $line2 = BillingAddressFieldMode::from(Json::toString(Json::get($data, 'line2')));

        return new self(
            country: $country,
            state: $state,
            city: $city,
            postal_code: $postal_code,
            line1: $line1,
            line2: $line2,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['country'] = Json::encode($this->country);
        $data['state'] = Json::encode($this->state);
        $data['city'] = Json::encode($this->city);
        $data['postal_code'] = Json::encode($this->postal_code);
        $data['line1'] = Json::encode($this->line1);
        $data['line2'] = Json::encode($this->line2);

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