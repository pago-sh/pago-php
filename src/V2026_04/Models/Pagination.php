<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Pagination
 */
final class Pagination implements Model, Deserializable
{
    public function __construct(
        public readonly int $total_count,
        public readonly int $max_page,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $total_count = Json::toInt(Json::get($data, 'total_count'));
        $max_page = Json::toInt(Json::get($data, 'max_page'));

        return new self(
            total_count: $total_count,
            max_page: $max_page,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['total_count'] = Json::encode($this->total_count);
        $data['max_page'] = Json::encode($this->max_page);

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