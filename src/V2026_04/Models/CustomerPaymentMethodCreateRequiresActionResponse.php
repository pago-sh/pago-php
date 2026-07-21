<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomerPaymentMethodCreateRequiresActionResponse
 */
final class CustomerPaymentMethodCreateRequiresActionResponse implements Model, Deserializable, CustomerPaymentMethodCreateResponse
{
    public function __construct(
        public readonly string $status,
        public readonly string $client_secret,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $status = Json::toString(Json::get($data, 'status'));
        $client_secret = Json::toString(Json::get($data, 'client_secret'));

        return new self(
            status: $status,
            client_secret: $client_secret,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['status'] = Json::encode($this->status);
        $data['client_secret'] = Json::encode($this->client_secret);

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