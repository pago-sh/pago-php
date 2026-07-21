<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Date interval limit to get metrics for a given interval.
 */
final class MetricsIntervalLimit implements Model, Deserializable
{
    public function __construct(
        public readonly int $min_days,
        public readonly int $max_days,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $min_days = Json::toInt(Json::get($data, 'min_days'));
        $max_days = Json::toInt(Json::get($data, 'max_days'));

        return new self(
            min_days: $min_days,
            max_days: $max_days,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['min_days'] = Json::encode($this->min_days);
        $data['max_days'] = Json::encode($this->max_days);

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