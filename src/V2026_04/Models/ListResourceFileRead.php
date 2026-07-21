<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * ListResourceFileRead
 */
final class ListResourceFileRead implements Model, Deserializable
{
    public function __construct(
        /**
         * @var list<FileRead>
         */
        public readonly array $items,
        public readonly Pagination $pagination,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var list<FileRead> $items */
        $items = array_map(static fn (mixed $item0): FileRead => FileReadFactory::fromArray(Json::toMap($item0)), Json::toList(Json::get($data, 'items')));
        $pagination = Pagination::fromArray(Json::toMap(Json::get($data, 'pagination')));

        return new self(
            items: $items,
            pagination: $pagination,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['items'] = Json::encode($this->items);
        $data['pagination'] = Json::encode($this->pagination);

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