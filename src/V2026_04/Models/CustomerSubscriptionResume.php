<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomerSubscriptionResume
 */
final class CustomerSubscriptionResume implements Model, Deserializable, CustomerSubscriptionUpdate
{
    public function __construct(
        public readonly bool $resume,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $resume = Json::toBool(Json::get($data, 'resume'));

        return new self(
            resume: $resume,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['resume'] = Json::encode($this->resume);

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