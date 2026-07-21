<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomerCustomerSession
 */
final class CustomerCustomerSession implements Model, Deserializable
{
    public function __construct(
        public readonly string $expires_at,
        /**
         * @var string|null
         */
        public readonly ?string $return_url,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $expires_at = Json::toString(Json::get($data, 'expires_at'));
        /** @var string|null $return_url */
        $return_url = (Json::get($data, 'return_url') === null ? null : Json::toString(Json::get($data, 'return_url')));

        return new self(
            expires_at: $expires_at,
            return_url: $return_url,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['expires_at'] = Json::encode($this->expires_at);
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