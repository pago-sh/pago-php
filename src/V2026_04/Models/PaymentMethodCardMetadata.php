<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * PaymentMethodCardMetadata
 */
final class PaymentMethodCardMetadata implements Model, Deserializable
{
    public function __construct(
        public readonly string $brand,
        public readonly string $last4,
        public readonly int $exp_month,
        public readonly int $exp_year,
        /**
         * @var string|null
         */
        public readonly ?string $wallet = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $brand = Json::toString(Json::get($data, 'brand'));
        $last4 = Json::toString(Json::get($data, 'last4'));
        $exp_month = Json::toInt(Json::get($data, 'exp_month'));
        $exp_year = Json::toInt(Json::get($data, 'exp_year'));
        /** @var string|null $wallet */
        $wallet = isset($data['wallet']) ? Json::toString($data['wallet']) : null;

        return new self(
            brand: $brand,
            last4: $last4,
            exp_month: $exp_month,
            exp_year: $exp_year,
            wallet: $wallet,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['brand'] = Json::encode($this->brand);
        $data['last4'] = Json::encode($this->last4);
        $data['exp_month'] = Json::encode($this->exp_month);
        $data['exp_year'] = Json::encode($this->exp_year);
        if ($this->wallet !== null) {
            $data['wallet'] = Json::encode($this->wallet);
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