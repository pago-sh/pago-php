<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CursorPagination
 */
final class CursorPagination implements Model, Deserializable
{
    public function __construct(
        public readonly bool $has_next_page,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $has_next_page = Json::toBool(Json::get($data, 'has_next_page'));

        return new self(
            has_next_page: $has_next_page,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['has_next_page'] = Json::encode($this->has_next_page);

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