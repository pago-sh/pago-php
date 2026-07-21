<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema for a fixed amount discount that is applied once or forever.
 */
final class CheckoutDiscountFixedOnceForeverDuration implements Model, Deserializable
{
    public function __construct(
        public readonly DiscountDuration $duration,
        public readonly DiscountType $type,
        /**
         * @deprecated
         */
        public readonly int $amount,
        /**
         * @deprecated
         */
        public readonly string $currency,
        /**
         * @var array<string, int>
         */
        public readonly array $amounts,
        public readonly string $id,
        public readonly string $name,
        /**
         * @var string|null
         */
        public readonly ?string $code,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $duration = DiscountDuration::from(Json::toString(Json::get($data, 'duration')));
        $type = DiscountType::from(Json::toString(Json::get($data, 'type')));
        $amount = Json::toInt(Json::get($data, 'amount'));
        $currency = Json::toString(Json::get($data, 'currency'));
        /** @var array<string, int> $amounts */
        $amounts = array_map(static fn (mixed $item0): int => Json::toInt($item0), Json::toMap(Json::get($data, 'amounts')));
        $id = Json::toString(Json::get($data, 'id'));
        $name = Json::toString(Json::get($data, 'name'));
        /** @var string|null $code */
        $code = (Json::get($data, 'code') === null ? null : Json::toString(Json::get($data, 'code')));

        return new self(
            duration: $duration,
            type: $type,
            amount: $amount,
            currency: $currency,
            amounts: $amounts,
            id: $id,
            name: $name,
            code: $code,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['duration'] = Json::encode($this->duration);
        $data['type'] = Json::encode($this->type);
        $data['amount'] = Json::encode($this->amount);
        $data['currency'] = Json::encode($this->currency);
        $data['amounts'] = Json::encode($this->amounts);
        $data['id'] = Json::encode($this->id);
        $data['name'] = Json::encode($this->name);
        $data['code'] = Json::encode($this->code);

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