<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\AggregationFunction;
use Pago\V2026_04\Models\ListResourceMeter;
use Pago\V2026_04\Models\Meter;
use Pago\V2026_04\Models\MeterCreate;
use Pago\V2026_04\Models\MeterQuantities;
use Pago\V2026_04\Models\MeterSortProperty;
use Pago\V2026_04\Models\MeterUpdate;
use Pago\V2026_04\Models\TimeInterval;
use Pago\V2026_04\Models\Timezone;

/**
 * Meters operations.
 */
final class MetersService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * List meters.
     *
     * **Scopes**: `meters:read` `meters:write`
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|null $query Filter by name.
     * @param bool|null $isArchived Filter on archived meters.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<MeterSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @param array<string, string|int|bool|list<string>|list<int>|list<bool>>|null $metadata Filter by metadata key-value pairs. It uses the `deepObject` style, e.g. `?metadata[key]=value`.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function list(
        string|array|null $organizationId = null,
        ?string $query = null,
        ?bool $isArchived = null,
        ?int $page = null,
        ?int $limit = null,
        ?array $sorting = null,
        ?array $metadata = null,
    ): ListResourceMeter {
        $response = $this->transport->request(
            'GET',
            '/v1/meters/',
            [
            ],
            [
                'organization_id' => Json::encode($organizationId),
                'query' => Json::encode($query),
                'is_archived' => Json::encode($isArchived),
                'page' => Json::encode($page),
                'limit' => Json::encode($limit),
                'sorting' => Json::encode($sorting),
                'metadata' => Json::encode($metadata),
            ],
            null,
            'json',
            [
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = ListResourceMeter::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List meters.
     *
     * Lazily iterates every page returned by {@see self::list()}.
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|null $query Filter by name.
     * @param bool|null $isArchived Filter on archived meters.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<MeterSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @param array<string, string|int|bool|list<string>|list<int>|list<bool>>|null $metadata Filter by metadata key-value pairs. It uses the `deepObject` style, e.g. `?metadata[key]=value`.
     * @return Page<Meter>
     */
    public function listPaginated(
        string|array|null $organizationId = null,
        ?string $query = null,
        ?bool $isArchived = null,
        ?int $limit = null,
        ?array $sorting = null,
        ?array $metadata = null,
    ): Page {
        /** @var \Closure(int): array{0: list<Meter>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($organizationId, $query, $isArchived, $limit, $sorting, $metadata): array {
            $result = $this->list(
                organizationId: $organizationId,
                query: $query,
                isArchived: $isArchived,
                page: $page,
                limit: $limit,
                sorting: $sorting,
                metadata: $metadata,
            );

            return [
                $result->items,
                $result->pagination->max_page,
            ];
        };

        return new Page($fetcher);
    }

    /**
     * Create a meter.
     *
     * **Scopes**: `meters:write`
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function create(
        MeterCreate $body,
    ): Meter {
        $response = $this->transport->request(
            'POST',
            '/v1/meters/',
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

        $result = Meter::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get a meter by ID.
     *
     * **Scopes**: `meters:read` `meters:write`
     *
     * @param $id The meter ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function get(
        string $id,
    ): Meter {
        $response = $this->transport->request(
            'GET',
            '/v1/meters/{id}',
            [
                'id' => Json::encode($id),
            ],
            [
            ],
            null,
            'json',
            [
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = Meter::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Update a meter.
     *
     * **Scopes**: `meters:write`
     *
     * @param $id The meter ID.
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function update(
        string $id,
        MeterUpdate $body,
    ): Meter {
        $response = $this->transport->request(
            'PATCH',
            '/v1/meters/{id}',
            [
                'id' => Json::encode($id),
            ],
            [
            ],
            Json::encode($body),
            'json',
            [
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = Meter::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get quantities of a meter over a time period.
     *
     * **Scopes**: `meters:read` `meters:write`
     *
     * @param $id The meter ID.
     * @param $startTimestamp Start timestamp.
     * @param $endTimestamp End timestamp.
     * @param $interval Interval between two timestamps.
     * @param Timezone|null $timezone Timezone to use for the timestamps. Default is UTC.
     * @param string|list<string>|null $customerId Filter by customer ID.
     * @param string|list<string>|null $externalCustomerId Filter by external customer ID.
     * @param AggregationFunction|null $customerAggregationFunction If set, will first compute the quantities per customer before aggregating them using the given function. If not set, the quantities will be aggregated across all events.
     * @param array<string, string|int|bool|list<string>|list<int>|list<bool>>|null $metadata Filter by metadata key-value pairs. It uses the `deepObject` style, e.g. `?metadata[key]=value`.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function quantities(
        string $id,
        string $startTimestamp,
        string $endTimestamp,
        TimeInterval $interval,
        ?Timezone $timezone = null,
        string|array|null $customerId = null,
        string|array|null $externalCustomerId = null,
        ?AggregationFunction $customerAggregationFunction = null,
        ?array $metadata = null,
    ): MeterQuantities {
        $response = $this->transport->request(
            'GET',
            '/v1/meters/{id}/quantities',
            [
                'id' => Json::encode($id),
            ],
            [
                'start_timestamp' => Json::encode($startTimestamp),
                'end_timestamp' => Json::encode($endTimestamp),
                'interval' => Json::encode($interval),
                'timezone' => Json::encode($timezone),
                'customer_id' => Json::encode($customerId),
                'external_customer_id' => Json::encode($externalCustomerId),
                'customer_aggregation_function' => Json::encode($customerAggregationFunction),
                'metadata' => Json::encode($metadata),
            ],
            null,
            'json',
            [
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = MeterQuantities::fromArray(Json::toMap($response));

        return $result;
    }
}