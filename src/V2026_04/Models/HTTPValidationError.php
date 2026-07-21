<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * HTTPValidationError
 */
final class HTTPValidationError implements Model, Deserializable
{
    public function __construct(
        /**
         * @var list<ValidationError>|null
         */
        public readonly ?array $detail = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var list<ValidationError>|null $detail */
        $detail = isset($data['detail']) ? array_map(static fn (mixed $item0): ValidationError => ValidationError::fromArray(Json::toMap($item0)), Json::toList($data['detail'])) : null;

        return new self(
            detail: $detail,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->detail !== null) {
            $data['detail'] = Json::encode($this->detail);
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