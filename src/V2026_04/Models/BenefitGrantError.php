<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * BenefitGrantError
 */
final class BenefitGrantError implements Model, Deserializable
{
    public function __construct(
        public readonly string $message,
        public readonly string $type,
        public readonly string $timestamp,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $message = Json::toString(Json::get($data, 'message'));
        $type = Json::toString(Json::get($data, 'type'));
        $timestamp = Json::toString(Json::get($data, 'timestamp'));

        return new self(
            message: $message,
            type: $type,
            timestamp: $timestamp,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['message'] = Json::encode($this->message);
        $data['type'] = Json::encode($this->type);
        $data['timestamp'] = Json::encode($this->timestamp);

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