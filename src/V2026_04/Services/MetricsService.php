<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\V2026_04\Models\MetricDashboardCreate;
use Pago\V2026_04\Models\MetricDashboardSchema;
use Pago\V2026_04\Models\MetricDashboardUpdate;
use Pago\V2026_04\Models\MetricsLimits;
use Pago\V2026_04\Models\MetricsResponse;
use Pago\V2026_04\Models\ProductBillingType;
use Pago\V2026_04\Models\TimeInterval;
use Pago\V2026_04\Models\Timezone;

/**
 * Metrics operations.
 */
final class MetricsService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * Get metrics about your orders and subscriptions.
     *
     * Currency values are output in cents.
     *
     * **Scopes**: `metrics:read`
     *
     * @param $startDate Start date.
     * @param $endDate End date.
     * @param $interval Interval between two timestamps.
     * @param Timezone|null $timezone Timezone to use for the timestamps. Default is UTC.
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $productId Filter by product ID.
     * @param ProductBillingType|list<ProductBillingType>|null $billingType Filter by billing type. `recurring` will filter data corresponding to subscriptions creations or renewals. `one_time` will filter data corresponding to one-time purchases.
     * @param string|list<string>|null $customerId Filter by customer ID.
     * @param list<string>|null $metrics List of metric slugs to focus on. When provided, only the queries needed for these metrics will be executed, improving performance. If not provided, all metrics are returned.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function get(
        string $startDate,
        string $endDate,
        TimeInterval $interval,
        ?Timezone $timezone = null,
        string|array|null $organizationId = null,
        string|array|null $productId = null,
        ProductBillingType|array|null $billingType = null,
        string|array|null $customerId = null,
        ?array $metrics = null,
    ): MetricsResponse {
        $response = $this->transport->request(
            'GET',
            '/v1/metrics/',
            [
            ],
            [
                'start_date' => Json::encode($startDate),
                'end_date' => Json::encode($endDate),
                'interval' => Json::encode($interval),
                'timezone' => Json::encode($timezone),
                'organization_id' => Json::encode($organizationId),
                'product_id' => Json::encode($productId),
                'billing_type' => Json::encode($billingType),
                'customer_id' => Json::encode($customerId),
                'metrics' => Json::encode($metrics),
            ],
            null,
            'json',
            [
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = MetricsResponse::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Export metrics as a CSV file.
     *
     * **Scopes**: `metrics:read`
     *
     * @param $startDate Start date.
     * @param $endDate End date.
     * @param $interval Interval between two timestamps.
     * @param Timezone|null $timezone Timezone to use for the timestamps. Default is UTC.
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $productId Filter by product ID.
     * @param ProductBillingType|list<ProductBillingType>|null $billingType Filter by billing type. `recurring` will filter data corresponding to subscriptions creations or renewals. `one_time` will filter data corresponding to one-time purchases.
     * @param string|list<string>|null $customerId Filter by customer ID.
     * @param list<string>|null $metrics List of metric slugs to include in the export. If not provided, all metrics are exported.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function export(
        string $startDate,
        string $endDate,
        TimeInterval $interval,
        ?Timezone $timezone = null,
        string|array|null $organizationId = null,
        string|array|null $productId = null,
        ProductBillingType|array|null $billingType = null,
        string|array|null $customerId = null,
        ?array $metrics = null,
    ): string {
        $response = $this->transport->request(
            'GET',
            '/v1/metrics/export',
            [
            ],
            [
                'start_date' => Json::encode($startDate),
                'end_date' => Json::encode($endDate),
                'interval' => Json::encode($interval),
                'timezone' => Json::encode($timezone),
                'organization_id' => Json::encode($organizationId),
                'product_id' => Json::encode($productId),
                'billing_type' => Json::encode($billingType),
                'customer_id' => Json::encode($customerId),
                'metrics' => Json::encode($metrics),
            ],
            null,
            'text',
            [
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = Json::toString($response);

        return $result;
    }

    /**
     * Get the interval limits for the metrics endpoint.
     *
     * **Scopes**: `metrics:read`
     *
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     */
    public function limits(): MetricsLimits
    {
        $response = $this->transport->request(
            'GET',
            '/v1/metrics/limits',
            [
            ],
            [
            ],
            null,
            'json',
            [
            ],
        );

        $result = MetricsLimits::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List user-defined metric dashboards.
     *
     * **Scopes**: `metrics:read`
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @return list<MetricDashboardSchema>
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function listDashboards(
        string|array|null $organizationId = null,
    ): array {
        $response = $this->transport->request(
            'GET',
            '/v1/metrics/dashboards',
            [
            ],
            [
                'organization_id' => Json::encode($organizationId),
            ],
            null,
            'json',
            [
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        /** @var list<MetricDashboardSchema> $result */
        $result = array_map(static fn (mixed $item0): MetricDashboardSchema => MetricDashboardSchema::fromArray(Json::toMap($item0)), Json::toList($response));

        return $result;
    }

    /**
     * Create a user-defined metric dashboard.
     *
     * **Scopes**: `metrics:write`
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function createDashboard(
        MetricDashboardCreate $body,
    ): MetricDashboardSchema {
        $response = $this->transport->request(
            'POST',
            '/v1/metrics/dashboards',
            [
            ],
            [
            ],
            Json::encode($body),
            'json',
            [
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = MetricDashboardSchema::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get a user-defined metric dashboard by ID.
     *
     * **Scopes**: `metrics:read`
     *
     * @param $id The metric dashboard ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function getDashboard(
        string $id,
    ): MetricDashboardSchema {
        $response = $this->transport->request(
            'GET',
            '/v1/metrics/dashboards/{id}',
            [
                'id' => Json::encode($id),
            ],
            [
            ],
            null,
            'json',
            [
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = MetricDashboardSchema::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Delete a user-defined metric dashboard.
     *
     * **Scopes**: `metrics:write`
     *
     * @param $id The metric dashboard ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function deleteDashboard(
        string $id,
    ): void {
        $this->transport->request(
            'DELETE',
            '/v1/metrics/dashboards/{id}',
            [
                'id' => Json::encode($id),
            ],
            [
            ],
            null,
            'none',
            [
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );
    }

    /**
     * Update a user-defined metric dashboard.
     *
     * **Scopes**: `metrics:write`
     *
     * @param $id The metric dashboard ID.
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function updateDashboard(
        string $id,
        MetricDashboardUpdate $body,
    ): MetricDashboardSchema {
        $response = $this->transport->request(
            'PATCH',
            '/v1/metrics/dashboards/{id}',
            [
                'id' => Json::encode($id),
            ],
            [
            ],
            Json::encode($body),
            'json',
            [
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = MetricDashboardSchema::fromArray(Json::toMap($response));

        return $result;
    }
}