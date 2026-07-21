<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\EventSource;
use Pago\V2026_04\Models\EventType;
use Pago\V2026_04\Models\EventTypeUpdate;
use Pago\V2026_04\Models\EventTypeWithStats;
use Pago\V2026_04\Models\EventTypesSortProperty;
use Pago\V2026_04\Models\ListResourceEventTypeWithStats;

/**
 * EventTypes operations.
 */
final class EventTypesService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * List event types with aggregated statistics.
     *
     * **Scopes**: `events:read` `events:write`
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $customerId Filter by customer ID.
     * @param string|list<string>|null $externalCustomerId Filter by external customer ID.
     * @param string|null $query Query to filter event types by name or label.
     * @param bool|null $rootEvents When true, only return event types with root events (parent_id IS NULL).
     * @param string|null $parentId Filter by specific parent event ID.
     * @param EventSource|null $source Filter by event source (system or user).
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<EventTypesSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function list(
        string|array|null $organizationId = null,
        string|array|null $customerId = null,
        string|array|null $externalCustomerId = null,
        ?string $query = null,
        ?bool $rootEvents = null,
        ?string $parentId = null,
        ?EventSource $source = null,
        ?int $page = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): ListResourceEventTypeWithStats {
        $response = $this->transport->request(
            'GET',
            '/v1/event-types/',
            [
            ],
            [
                'organization_id' => Json::encode($organizationId),
                'customer_id' => Json::encode($customerId),
                'external_customer_id' => Json::encode($externalCustomerId),
                'query' => Json::encode($query),
                'root_events' => Json::encode($rootEvents),
                'parent_id' => Json::encode($parentId),
                'source' => Json::encode($source),
                'page' => Json::encode($page),
                'limit' => Json::encode($limit),
                'sorting' => Json::encode($sorting),
            ],
            null,
            'json',
            [
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = ListResourceEventTypeWithStats::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List event types with aggregated statistics.
     *
     * Lazily iterates every page returned by {@see self::list()}.
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $customerId Filter by customer ID.
     * @param string|list<string>|null $externalCustomerId Filter by external customer ID.
     * @param string|null $query Query to filter event types by name or label.
     * @param bool|null $rootEvents When true, only return event types with root events (parent_id IS NULL).
     * @param string|null $parentId Filter by specific parent event ID.
     * @param EventSource|null $source Filter by event source (system or user).
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<EventTypesSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @return Page<EventTypeWithStats>
     */
    public function listPaginated(
        string|array|null $organizationId = null,
        string|array|null $customerId = null,
        string|array|null $externalCustomerId = null,
        ?string $query = null,
        ?bool $rootEvents = null,
        ?string $parentId = null,
        ?EventSource $source = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): Page {
        /** @var \Closure(int): array{0: list<EventTypeWithStats>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($organizationId, $customerId, $externalCustomerId, $query, $rootEvents, $parentId, $source, $limit, $sorting): array {
            $result = $this->list(
                organizationId: $organizationId,
                customerId: $customerId,
                externalCustomerId: $externalCustomerId,
                query: $query,
                rootEvents: $rootEvents,
                parentId: $parentId,
                source: $source,
                page: $page,
                limit: $limit,
                sorting: $sorting,
            );

            return [
                $result->items,
                $result->pagination->max_page,
            ];
        };

        return new Page($fetcher);
    }

    /**
     * Update an event type's label.
     *
     * **Scopes**: `events:write`
     *
     * @param $id The event type ID.
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\Update404Error on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function update(
        string $id,
        EventTypeUpdate $body,
    ): EventType {
        $response = $this->transport->request(
            'PATCH',
            '/v1/event-types/{id}',
            [
                'id' => Json::encode($id),
            ],
            [
            ],
            Json::encode($body),
            'json',
            [
                404 => \Pago\V2026_04\Errors\Update404Error::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = EventType::fromArray(Json::toMap($response));

        return $result;
    }
}