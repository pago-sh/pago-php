<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Response after confirming a retry payment.
 */
final class CustomerOrderPaymentConfirmation implements Model, Deserializable
{
    public function __construct(
        public readonly string $status,
        /**
         * @var string|null
         */
        public readonly ?string $client_secret = null,
        /**
         * @var string|null
         */
        public readonly ?string $error = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $status = Json::toString(Json::get($data, 'status'));
        /** @var string|null $client_secret */
        $client_secret = isset($data['client_secret']) ? Json::toString($data['client_secret']) : null;
        /** @var string|null $error */
        $error = isset($data['error']) ? Json::toString($data['error']) : null;

        return new self(
            status: $status,
            client_secret: $client_secret,
            error: $error,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['status'] = Json::encode($this->status);
        if ($this->client_secret !== null) {
            $data['client_secret'] = Json::encode($this->client_secret);
        }
        if ($this->error !== null) {
            $data['error'] = Json::encode($this->error);
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