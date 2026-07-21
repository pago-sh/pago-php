<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Metrics response schema.
 */
final class MetricsResponse implements Model, Deserializable
{
    public function __construct(
        /**
         * @var list<MetricPeriod>
         */
        public readonly array $periods,
        public readonly MetricsTotals $totals,
        public readonly Metrics $metrics,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var list<MetricPeriod> $periods */
        $periods = array_map(static fn (mixed $item0): MetricPeriod => MetricPeriod::fromArray(Json::toMap($item0)), Json::toList(Json::get($data, 'periods')));
        $totals = MetricsTotals::fromArray(Json::toMap(Json::get($data, 'totals')));
        $metrics = Metrics::fromArray(Json::toMap(Json::get($data, 'metrics')));

        return new self(
            periods: $periods,
            totals: $totals,
            metrics: $metrics,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['periods'] = Json::encode($this->periods);
        $data['totals'] = Json::encode($this->totals);
        $data['metrics'] = Json::encode($this->metrics);

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