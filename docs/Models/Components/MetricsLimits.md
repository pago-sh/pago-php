# MetricsLimits

Date limits to get metrics.


## Fields

| Field                                                                                  | Type                                                                                   | Required                                                                               | Description                                                                            |
| -------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------- |
| `minDate`                                                                              | [\DateTime](https://www.php.net/manual/en/class.datetime.php)                          | :heavy_check_mark:                                                                     | Minimum date to get metrics.                                                           |
| `intervals`                                                                            | [Components\MetricsIntervalsLimits](../../Models/Components/MetricsIntervalsLimits.md) | :heavy_check_mark:                                                                     | Date interval limits to get metrics for each interval.                                 |