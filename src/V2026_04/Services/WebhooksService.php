<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\ListResourceWebhookDelivery;
use Pago\V2026_04\Models\ListResourceWebhookEndpoint;
use Pago\V2026_04\Models\WebhookDelivery;
use Pago\V2026_04\Models\WebhookEndpoint;
use Pago\V2026_04\Models\WebhookEndpointCreate;
use Pago\V2026_04\Models\WebhookEndpointUpdate;
use Pago\V2026_04\Models\WebhookEventType;

/**
 * Webhooks operations.
 */
final class WebhooksService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * List webhook endpoints.
     *
     * **Scopes**: `webhooks:read` `webhooks:write`
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function listWebhookEndpoints(
        string|array|null $organizationId = null,
        ?int $page = null,
        ?int $limit = null,
    ): ListResourceWebhookEndpoint {
        $response = $this->transport->request(
            'GET',
            '/v1/webhooks/endpoints',
            [
            ],
            [
                'organization_id' => Json::encode($organizationId),
                'page' => Json::encode($page),
                'limit' => Json::encode($limit),
            ],
            null,
            'json',
            [
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = ListResourceWebhookEndpoint::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List webhook endpoints.
     *
     * Lazily iterates every page returned by {@see self::listWebhookEndpoints()}.
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @return Page<WebhookEndpoint>
     */
    public function listWebhookEndpointsPaginated(
        string|array|null $organizationId = null,
        ?int $limit = null,
    ): Page {
        /** @var \Closure(int): array{0: list<WebhookEndpoint>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($organizationId, $limit): array {
            $result = $this->listWebhookEndpoints(
                organizationId: $organizationId,
                page: $page,
                limit: $limit,
            );

            return [
                $result->items,
                $result->pagination->max_page,
            ];
        };

        return new Page($fetcher);
    }

    /**
     * Create a webhook endpoint.
     *
     * **Scopes**: `webhooks:write`
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function createWebhookEndpoint(
        WebhookEndpointCreate $body,
    ): WebhookEndpoint {
        $response = $this->transport->request(
            'POST',
            '/v1/webhooks/endpoints',
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

        $result = WebhookEndpoint::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get a webhook endpoint by ID.
     *
     * **Scopes**: `webhooks:read` `webhooks:write`
     *
     * @param $id The webhook endpoint ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function getWebhookEndpoint(
        string $id,
    ): WebhookEndpoint {
        $response = $this->transport->request(
            'GET',
            '/v1/webhooks/endpoints/{id}',
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

        $result = WebhookEndpoint::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Delete a webhook endpoint.
     *
     * **Scopes**: `webhooks:write`
     *
     * @param $id The webhook endpoint ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function deleteWebhookEndpoint(
        string $id,
    ): void {
        $this->transport->request(
            'DELETE',
            '/v1/webhooks/endpoints/{id}',
            [
                'id' => Json::encode($id),
            ],
            [
            ],
            null,
            'none',
            [
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );
    }

    /**
     * Update a webhook endpoint.
     *
     * **Scopes**: `webhooks:write`
     *
     * @param $id The webhook endpoint ID.
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function updateWebhookEndpoint(
        string $id,
        WebhookEndpointUpdate $body,
    ): WebhookEndpoint {
        $response = $this->transport->request(
            'PATCH',
            '/v1/webhooks/endpoints/{id}',
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

        $result = WebhookEndpoint::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Regenerate a webhook endpoint secret.
     *
     * **Scopes**: `webhooks:write`
     *
     * @param $id The webhook endpoint ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function resetWebhookEndpointSecret(
        string $id,
    ): WebhookEndpoint {
        $response = $this->transport->request(
            'PATCH',
            '/v1/webhooks/endpoints/{id}/secret',
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

        $result = WebhookEndpoint::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List webhook deliveries.
     *
     * Deliveries are all the attempts to deliver a webhook event to an endpoint.
     *
     * **Scopes**: `webhooks:read` `webhooks:write`
     *
     * @param string|list<string>|null $endpointId Filter by webhook endpoint ID.
     * @param string|null $startTimestamp Filter deliveries after this timestamp.
     * @param string|null $endTimestamp Filter deliveries before this timestamp.
     * @param bool|null $succeeded Filter by delivery success status.
     * @param string|null $query Query to filter webhook deliveries.
     * @param string|null $httpCodeClass Filter by HTTP response code class (2xx, 3xx, 4xx, 5xx).
     * @param WebhookEventType|list<WebhookEventType>|null $eventType Filter by webhook event type.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function listWebhookDeliveries(
        string|array|null $endpointId = null,
        ?string $startTimestamp = null,
        ?string $endTimestamp = null,
        ?bool $succeeded = null,
        ?string $query = null,
        ?string $httpCodeClass = null,
        WebhookEventType|array|null $eventType = null,
        ?int $page = null,
        ?int $limit = null,
    ): ListResourceWebhookDelivery {
        $response = $this->transport->request(
            'GET',
            '/v1/webhooks/deliveries',
            [
            ],
            [
                'endpoint_id' => Json::encode($endpointId),
                'start_timestamp' => Json::encode($startTimestamp),
                'end_timestamp' => Json::encode($endTimestamp),
                'succeeded' => Json::encode($succeeded),
                'query' => Json::encode($query),
                'http_code_class' => Json::encode($httpCodeClass),
                'event_type' => Json::encode($eventType),
                'page' => Json::encode($page),
                'limit' => Json::encode($limit),
            ],
            null,
            'json',
            [
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = ListResourceWebhookDelivery::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List webhook deliveries.
     *
     * Lazily iterates every page returned by {@see self::listWebhookDeliveries()}.
     *
     * @param string|list<string>|null $endpointId Filter by webhook endpoint ID.
     * @param string|null $startTimestamp Filter deliveries after this timestamp.
     * @param string|null $endTimestamp Filter deliveries before this timestamp.
     * @param bool|null $succeeded Filter by delivery success status.
     * @param string|null $query Query to filter webhook deliveries.
     * @param string|null $httpCodeClass Filter by HTTP response code class (2xx, 3xx, 4xx, 5xx).
     * @param WebhookEventType|list<WebhookEventType>|null $eventType Filter by webhook event type.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @return Page<WebhookDelivery>
     */
    public function listWebhookDeliveriesPaginated(
        string|array|null $endpointId = null,
        ?string $startTimestamp = null,
        ?string $endTimestamp = null,
        ?bool $succeeded = null,
        ?string $query = null,
        ?string $httpCodeClass = null,
        WebhookEventType|array|null $eventType = null,
        ?int $limit = null,
    ): Page {
        /** @var \Closure(int): array{0: list<WebhookDelivery>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($endpointId, $startTimestamp, $endTimestamp, $succeeded, $query, $httpCodeClass, $eventType, $limit): array {
            $result = $this->listWebhookDeliveries(
                endpointId: $endpointId,
                startTimestamp: $startTimestamp,
                endTimestamp: $endTimestamp,
                succeeded: $succeeded,
                query: $query,
                httpCodeClass: $httpCodeClass,
                eventType: $eventType,
                page: $page,
                limit: $limit,
            );

            return [
                $result->items,
                $result->pagination->max_page,
            ];
        };

        return new Page($fetcher);
    }

    /**
     * Schedule the re-delivery of a webhook event.
     *
     * **Scopes**: `webhooks:write`
     *
     * @param $id The webhook event ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function redeliverWebhookEvent(
        string $id,
    ): mixed {
        $response = $this->transport->request(
            'POST',
            '/v1/webhooks/events/{id}/redeliver',
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

        $result = $response;

        return $result;
    }
}