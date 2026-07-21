<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomerPaymentMethodCreateSucceededResponse
 */
final class CustomerPaymentMethodCreateSucceededResponse implements Model, Deserializable, CustomerPaymentMethodCreateResponse
{
    public function __construct(
        public readonly string $status,
        public readonly CustomerPaymentMethod $payment_method,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $status = Json::toString(Json::get($data, 'status'));
        $payment_method = CustomerPaymentMethodFactory::fromArray(Json::toMap(Json::get($data, 'payment_method')));

        return new self(
            status: $status,
            payment_method: $payment_method,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['status'] = Json::encode($this->status);
        $data['payment_method'] = Json::encode($this->payment_method);

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