<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema to finalize a draft order and trigger an off-session charge.
 */
final class OrderFinalize implements Model, Deserializable
{
    public function __construct(
        /**
         * @var string|null
         */
        public readonly ?string $payment_method_id = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var string|null $payment_method_id */
        $payment_method_id = isset($data['payment_method_id']) ? Json::toString($data['payment_method_id']) : null;

        return new self(
            payment_method_id: $payment_method_id,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->payment_method_id !== null) {
            $data['payment_method_id'] = Json::encode($this->payment_method_id);
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