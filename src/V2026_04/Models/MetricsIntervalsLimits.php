<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Date interval limits to get metrics for each interval.
 */
final class MetricsIntervalsLimits implements Model, Deserializable
{
    public function __construct(
        public readonly MetricsIntervalLimit $hour,
        public readonly MetricsIntervalLimit $day,
        public readonly MetricsIntervalLimit $week,
        public readonly MetricsIntervalLimit $month,
        public readonly MetricsIntervalLimit $year,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $hour = MetricsIntervalLimit::fromArray(Json::toMap(Json::get($data, 'hour')));
        $day = MetricsIntervalLimit::fromArray(Json::toMap(Json::get($data, 'day')));
        $week = MetricsIntervalLimit::fromArray(Json::toMap(Json::get($data, 'week')));
        $month = MetricsIntervalLimit::fromArray(Json::toMap(Json::get($data, 'month')));
        $year = MetricsIntervalLimit::fromArray(Json::toMap(Json::get($data, 'year')));

        return new self(
            hour: $hour,
            day: $day,
            week: $week,
            month: $month,
            year: $year,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['hour'] = Json::encode($this->hour);
        $data['day'] = Json::encode($this->day);
        $data['week'] = Json::encode($this->week);
        $data['month'] = Json::encode($this->month);
        $data['year'] = Json::encode($this->year);

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