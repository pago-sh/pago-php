<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * A wallet represents your balance with an organization.
 *
 * You can top-up your wallet and use the balance to pay for usage.
 */
final class CustomerWallet implements Model, Deserializable
{
    public function __construct(
        public readonly string $id,
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $customer_id,
        public readonly int $balance,
        public readonly string $currency,
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
        $customer_id = Json::toString(Json::get($data, 'customer_id'));
        $balance = Json::toInt(Json::get($data, 'balance'));
        $currency = Json::toString(Json::get($data, 'currency'));

        return new self(
            id: $id,
            created_at: $created_at,
            modified_at: $modified_at,
            customer_id: $customer_id,
            balance: $balance,
            currency: $currency,
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
        $data['customer_id'] = Json::encode($this->customer_id);
        $data['balance'] = Json::encode($this->balance);
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