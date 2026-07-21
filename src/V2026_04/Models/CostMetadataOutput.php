<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CostMetadataOutput
 */
final class CostMetadataOutput implements Model, Deserializable
{
    public function __construct(
        public readonly string $amount,
        public readonly string $currency,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $amount = Json::toString(Json::get($data, 'amount'));
        $currency = Json::toString(Json::get($data, 'currency'));

        return new self(
            amount: $amount,
            currency: $currency,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['amount'] = Json::encode($this->amount);
        $data['currency'] = Json::encode($this->currency);

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