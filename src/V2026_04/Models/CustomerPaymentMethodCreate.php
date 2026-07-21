<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomerPaymentMethodCreate
 */
final class CustomerPaymentMethodCreate implements Model, Deserializable
{
    public function __construct(
        public readonly string $confirmation_token_id,
        public readonly bool $set_default,
        public readonly string $return_url,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $confirmation_token_id = Json::toString(Json::get($data, 'confirmation_token_id'));
        $set_default = Json::toBool(Json::get($data, 'set_default'));
        $return_url = Json::toString(Json::get($data, 'return_url'));

        return new self(
            confirmation_token_id: $confirmation_token_id,
            set_default: $set_default,
            return_url: $return_url,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['confirmation_token_id'] = Json::encode($this->confirmation_token_id);
        $data['set_default'] = Json::encode($this->set_default);
        $data['return_url'] = Json::encode($this->return_url);

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