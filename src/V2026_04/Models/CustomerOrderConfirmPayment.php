<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema to confirm a retry payment using either a saved payment method or a new confirmation token.
 */
final class CustomerOrderConfirmPayment implements Model, Deserializable
{
    public function __construct(
        /**
         * @var string|null
         */
        public readonly ?string $confirmation_token_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $payment_method_id = null,
        /**
         * @var PaymentProcessor|null
         */
        public readonly ?PaymentProcessor $payment_processor = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var string|null $confirmation_token_id */
        $confirmation_token_id = isset($data['confirmation_token_id']) ? Json::toString($data['confirmation_token_id']) : null;
        /** @var string|null $payment_method_id */
        $payment_method_id = isset($data['payment_method_id']) ? Json::toString($data['payment_method_id']) : null;
        /** @var PaymentProcessor|null $payment_processor */
        $payment_processor = isset($data['payment_processor']) ? PaymentProcessor::from(Json::toString($data['payment_processor'])) : null;

        return new self(
            confirmation_token_id: $confirmation_token_id,
            payment_method_id: $payment_method_id,
            payment_processor: $payment_processor,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->confirmation_token_id !== null) {
            $data['confirmation_token_id'] = Json::encode($this->confirmation_token_id);
        }
        if ($this->payment_method_id !== null) {
            $data['payment_method_id'] = Json::encode($this->payment_method_id);
        }
        if ($this->payment_processor !== null) {
            $data['payment_processor'] = Json::encode($this->payment_processor);
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