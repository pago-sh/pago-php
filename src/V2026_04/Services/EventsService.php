<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\Event;
use Pago\V2026_04\Models\EventFactory;
use Pago\V2026_04\Models\EventName;
use Pago\V2026_04\Models\EventNamesSortProperty;
use Pago\V2026_04\Models\EventSortProperty;
use Pago\V2026_04\Models\EventSource;
use Pago\V2026_04\Models\EventsIngest;
use Pago\V2026_04\Models\EventsIngestResponse;
use Pago\V2026_04\Models\ListResourceEvent;
use Pago\V2026_04\Models\ListResourceEventName;
use Pago\V2026_04\Models\ListResourceWithCursorPaginationEvent;

/**
 * Events operations.
 */
final class EventsService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * List events.
     *
     * **Scopes**: `events:read` `events:write`
     *
     * @param string|null $filter Filter events following filter clauses. JSON string following the same schema a meter filter clause.
     * @param string|null $startTimestamp Filter events after this timestamp.
     * @param string|null $endTimestamp Filter events before this timestamp.
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $customerId Filter by customer ID.
     * @param string|list<string>|null $externalCustomerId Filter by external customer ID.
     * @param string|null $meterId Filter by a meter filter clause.
     * @param string|list<string>|null $name Filter by event name.
     * @param EventSource|list<EventSource>|null $source Filter by event source.
     * @param string|null $query Query to filter events.
     * @param string|null $parentId When combined with depth, use this event as the anchor instead of root events.
     * @param int|null $depth Fetch descendants up to this depth. When set: 0=root events only, 1=roots+children, etc. Max 5. When not set, returns all events.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<EventSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @param array<string, string|int|bool|list<string>|list<int>|list<bool>>|null $metadata Filter by metadata key-value pairs. It uses the `deepObject` style, e.g. `?metadata[key]=value`.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function list(
        ?string $filter = null,
        ?string $startTimestamp = null,
        ?string $endTimestamp = null,
        string|array|null $organizationId = null,
        string|array|null $customerId = null,
        string|array|null $externalCustomerId = null,
        ?string $meterId = null,
        string|array|null $name = null,
        EventSource|array|null $source = null,
        ?string $query = null,
        ?string $parentId = null,
        ?int $depth = null,
        ?int $page = null,
        ?int $limit = null,
        ?array $sorting = null,
        ?array $metadata = null,
    ): ListResourceEvent|ListResourceWithCursorPaginationEvent {
        $response = $this->transport->request(
            'GET',
            '/v1/events/',
            [
            ],
            [
                'filter' => Json::encode($filter),
                'start_timestamp' => Json::encode($startTimestamp),
                'end_timestamp' => Json::encode($endTimestamp),
                'organization_id' => Json::encode($organizationId),
                'customer_id' => Json::encode($customerId),
                'external_customer_id' => Json::encode($externalCustomerId),
                'meter_id' => Json::encode($meterId),
                'name' => Json::encode($name),
                'source' => Json::encode($source),
                'query' => Json::encode($query),
                'parent_id' => Json::encode($parentId),
                'depth' => Json::encode($depth),
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

        /** @var ListResourceEvent|ListResourceWithCursorPaginationEvent $result */
        $result = Union::resolve($response, null, [], [ListResourceEvent::class, ListResourceWithCursorPaginationEvent::class]);

        return $result;
    }

    /**
     * List event names.
     *
     * **Scopes**: `events:read` `events:write`
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $customerId Filter by customer ID.
     * @param string|list<string>|null $externalCustomerId Filter by external customer ID.
     * @param EventSource|list<EventSource>|null $source Filter by event source.
     * @param string|null $query Query to filter event names.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<EventNamesSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function listNames(
        string|array|null $organizationId = null,
        string|array|null $customerId = null,
        string|array|null $externalCustomerId = null,
        EventSource|array|null $source = null,
        ?string $query = null,
        ?int $page = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): ListResourceEventName {
        $response = $this->transport->request(
            'GET',
            '/v1/events/names',
            [
            ],
            [
                'organization_id' => Json::encode($organizationId),
                'customer_id' => Json::encode($customerId),
                'external_customer_id' => Json::encode($externalCustomerId),
                'source' => Json::encode($source),
                'query' => Json::encode($query),
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

        $result = ListResourceEventName::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List event names.
     *
     * Lazily iterates every page returned by {@see self::listNames()}.
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $customerId Filter by customer ID.
     * @param string|list<string>|null $externalCustomerId Filter by external customer ID.
     * @param EventSource|list<EventSource>|null $source Filter by event source.
     * @param string|null $query Query to filter event names.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<EventNamesSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @return Page<EventName>
     */
    public function listNamesPaginated(
        string|array|null $organizationId = null,
        string|array|null $customerId = null,
        string|array|null $externalCustomerId = null,
        EventSource|array|null $source = null,
        ?string $query = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): Page {
        /** @var \Closure(int): array{0: list<EventName>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($organizationId, $customerId, $externalCustomerId, $source, $query, $limit, $sorting): array {
            $result = $this->listNames(
                organizationId: $organizationId,
                customerId: $customerId,
                externalCustomerId: $externalCustomerId,
                source: $source,
                query: $query,
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
     * Get an event by ID.
     *
     * **Scopes**: `events:read` `events:write`
     *
     * @param $id The event ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function get(
        string $id,
    ): Event {
        $response = $this->transport->request(
            'GET',
            '/v1/events/{id}',
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

        $result = EventFactory::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Ingest batch of events.
     *
     * **Scopes**: `events:write`
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function ingest(
        EventsIngest $body,
    ): EventsIngestResponse {
        $response = $this->transport->request(
            'POST',
            '/v1/events/ingest',
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

        $result = EventsIngestResponse::fromArray(Json::toMap($response));

        return $result;
    }
}