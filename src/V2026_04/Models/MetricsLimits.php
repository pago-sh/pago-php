<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Date limits to get metrics.
 */
final class MetricsLimits implements Model, Deserializable
{
    public function __construct(
        public readonly string $min_date,
        public readonly MetricsIntervalsLimits $intervals,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $min_date = Json::toString(Json::get($data, 'min_date'));
        $intervals = MetricsIntervalsLimits::fromArray(Json::toMap(Json::get($data, 'intervals')));

        return new self(
            min_date: $min_date,
            intervals: $intervals,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['min_date'] = Json::encode($this->min_date);
        $data['intervals'] = Json::encode($this->intervals);

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