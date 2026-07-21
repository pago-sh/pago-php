<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * PaymentFailed
 */
final class PaymentFailed implements Model, Deserializable
{
    public function __construct(
        public readonly string $error,
        public readonly string $detail,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $error = Json::toString(Json::get($data, 'error'));
        $detail = Json::toString(Json::get($data, 'detail'));

        return new self(
            error: $error,
            detail: $detail,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['error'] = Json::encode($this->error);
        $data['detail'] = Json::encode($this->detail);

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