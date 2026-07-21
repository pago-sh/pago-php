<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services\CustomerPortal;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\CustomerSubscription;
use Pago\V2026_04\Models\CustomerSubscriptionSortProperty;
use Pago\V2026_04\Models\CustomerSubscriptionUpdate;
use Pago\V2026_04\Models\CustomerSubscriptionUpdateFactory;
use Pago\V2026_04\Models\ListResourceCustomerSubscription;

/**
 * Subscriptions operations.
 */
final class SubscriptionsService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * List subscriptions of the authenticated customer.
     *
     * **Scopes**: `customer_portal:read` `customer_portal:write`
     *
     * @param string|list<string>|null $productId Filter by product ID.
     * @param bool|null $active Filter by active or cancelled subscription.
     * @param string|null $query Search by product or organization name.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<CustomerSubscriptionSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function list(
        string|array|null $productId = null,
        ?bool $active = null,
        ?string $query = null,
        ?int $page = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): ListResourceCustomerSubscription {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-portal/subscriptions/',
            [
            ],
            [
                'product_id' => Json::encode($productId),
                'active' => Json::encode($active),
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

        $result = ListResourceCustomerSubscription::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List subscriptions of the authenticated customer.
     *
     * Lazily iterates every page returned by {@see self::list()}.
     *
     * @param string|list<string>|null $productId Filter by product ID.
     * @param bool|null $active Filter by active or cancelled subscription.
     * @param string|null $query Search by product or organization name.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<CustomerSubscriptionSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @return Page<CustomerSubscription>
     */
    public function listPaginated(
        string|array|null $productId = null,
        ?bool $active = null,
        ?string $query = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): Page {
        /** @var \Closure(int): array{0: list<CustomerSubscription>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($productId, $active, $query, $limit, $sorting): array {
            $result = $this->list(
                productId: $productId,
                active: $active,
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
     * Get a subscription for the authenticated customer.
     *
     * **Scopes**: `customer_portal:read` `customer_portal:write`
     *
     * @param $id The subscription ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function get(
        string $id,
    ): CustomerSubscription {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-portal/subscriptions/{id}',
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

        $result = CustomerSubscription::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Cancel a subscription of the authenticated customer.
     *
     * @param $id The subscription ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\AlreadyCanceledSubscription on HTTP 403
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function cancel(
        string $id,
    ): CustomerSubscription {
        $response = $this->transport->request(
            'DELETE',
            '/v1/customer-portal/subscriptions/{id}',
            [
                'id' => Json::encode($id),
            ],
            [
            ],
            null,
            'json',
            [
                403 => \Pago\V2026_04\Errors\AlreadyCanceledSubscription::class,
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = CustomerSubscription::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Update a subscription of the authenticated customer.
     *
     * @param $id The subscription ID.
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\PaymentFailed on HTTP 402
     * @throws \Pago\V2026_04\Errors\Update403Error on HTTP 403
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function update(
        string $id,
        CustomerSubscriptionUpdate $body,
    ): CustomerSubscription {
        $response = $this->transport->request(
            'PATCH',
            '/v1/customer-portal/subscriptions/{id}',
            [
                'id' => Json::encode($id),
            ],
            [
            ],
            Json::encode($body),
            'json',
            [
                402 => \Pago\V2026_04\Errors\PaymentFailed::class,
                403 => \Pago\V2026_04\Errors\Update403Error::class,
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = CustomerSubscription::fromArray(Json::toMap($response));

        return $result;
    }
}