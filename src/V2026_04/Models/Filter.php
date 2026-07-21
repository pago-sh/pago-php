<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Filter
 */
final class Filter implements Model, Deserializable
{
    public function __construct(
        public readonly FilterConjunction $conjunction,
        /**
         * @var list<FilterClause|Filter>
         */
        public readonly array $clauses,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $conjunction = FilterConjunction::from(Json::toString(Json::get($data, 'conjunction')));
        /** @var list<FilterClause|Filter> $clauses */
        $clauses = array_map(static fn (mixed $item0): mixed => Union::resolve($item0, null, [], [FilterClause::class, Filter::class]), Json::toList(Json::get($data, 'clauses')));

        return new self(
            conjunction: $conjunction,
            clauses: $clauses,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['conjunction'] = Json::encode($this->conjunction);
        $data['clauses'] = Json::encode($this->clauses);

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