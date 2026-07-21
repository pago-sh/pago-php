<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomerPaymentMethodConfirm
 */
final class CustomerPaymentMethodConfirm implements Model, Deserializable
{
    public function __construct(
        public readonly string $setup_intent_id,
        public readonly bool $set_default,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $setup_intent_id = Json::toString(Json::get($data, 'setup_intent_id'));
        $set_default = Json::toBool(Json::get($data, 'set_default'));

        return new self(
            setup_intent_id: $setup_intent_id,
            set_default: $set_default,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['setup_intent_id'] = Json::encode($this->setup_intent_id);
        $data['set_default'] = Json::encode($this->set_default);

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