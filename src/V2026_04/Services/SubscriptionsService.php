<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\CustomerCancellationReason;
use Pago\V2026_04\Models\ListResourceSubscription;
use Pago\V2026_04\Models\Subscription;
use Pago\V2026_04\Models\SubscriptionCreateCustomer;
use Pago\V2026_04\Models\SubscriptionCreateExternalCustomer;
use Pago\V2026_04\Models\SubscriptionSortProperty;
use Pago\V2026_04\Models\SubscriptionStatus;
use Pago\V2026_04\Models\SubscriptionUpdate;
use Pago\V2026_04\Models\SubscriptionUpdateFactory;

/**
 * Subscriptions operations.
 */
final class SubscriptionsService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * List subscriptions.
     *
     * **Scopes**: `subscriptions:read` `subscriptions:write`
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $productId Filter by product ID.
     * @param string|list<string>|null $customerId Filter by customer ID.
     * @param string|list<string>|null $externalCustomerId Filter by customer external ID.
     * @param string|list<string>|null $discountId Filter by discount ID.
     * @param bool|null $active Filter by active or inactive subscription.
     * @param SubscriptionStatus|list<SubscriptionStatus>|null $status Filter by subscription status.
     * @param bool|null $cancelAtPeriodEnd Filter by subscriptions that are set to cancel at period end.
     * @param CustomerCancellationReason|list<CustomerCancellationReason>|null $customerCancellationReason Filter by customer cancellation reason.
     * @param string|null $canceledAtAfter Filter by cancellation date (after or equal to).
     * @param string|null $canceledAtBefore Filter by cancellation date (before or equal to).
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<SubscriptionSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @param array<string, string|int|bool|list<string>|list<int>|list<bool>>|null $metadata Filter by metadata key-value pairs. It uses the `deepObject` style, e.g. `?metadata[key]=value`.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function list(
        string|array|null $organizationId = null,
        string|array|null $productId = null,
        string|array|null $customerId = null,
        string|array|null $externalCustomerId = null,
        string|array|null $discountId = null,
        ?bool $active = null,
        SubscriptionStatus|array|null $status = null,
        ?bool $cancelAtPeriodEnd = null,
        CustomerCancellationReason|array|null $customerCancellationReason = null,
        ?string $canceledAtAfter = null,
        ?string $canceledAtBefore = null,
        ?int $page = null,
        ?int $limit = null,
        ?array $sorting = null,
        ?array $metadata = null,
    ): ListResourceSubscription {
        $response = $this->transport->request(
            'GET',
            '/v1/subscriptions/',
            [
            ],
            [
                'organization_id' => Json::encode($organizationId),
                'product_id' => Json::encode($productId),
                'customer_id' => Json::encode($customerId),
                'external_customer_id' => Json::encode($externalCustomerId),
                'discount_id' => Json::encode($discountId),
                'active' => Json::encode($active),
                'status' => Json::encode($status),
                'cancel_at_period_end' => Json::encode($cancelAtPeriodEnd),
                'customer_cancellation_reason' => Json::encode($customerCancellationReason),
                'canceled_at_after' => Json::encode($canceledAtAfter),
                'canceled_at_before' => Json::encode($canceledAtBefore),
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

        $result = ListResourceSubscription::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List subscriptions.
     *
     * Lazily iterates every page returned by {@see self::list()}.
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $productId Filter by product ID.
     * @param string|list<string>|null $customerId Filter by customer ID.
     * @param string|list<string>|null $externalCustomerId Filter by customer external ID.
     * @param string|list<string>|null $discountId Filter by discount ID.
     * @param bool|null $active Filter by active or inactive subscription.
     * @param SubscriptionStatus|list<SubscriptionStatus>|null $status Filter by subscription status.
     * @param bool|null $cancelAtPeriodEnd Filter by subscriptions that are set to cancel at period end.
     * @param CustomerCancellationReason|list<CustomerCancellationReason>|null $customerCancellationReason Filter by customer cancellation reason.
     * @param string|null $canceledAtAfter Filter by cancellation date (after or equal to).
     * @param string|null $canceledAtBefore Filter by cancellation date (before or equal to).
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<SubscriptionSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @param array<string, string|int|bool|list<string>|list<int>|list<bool>>|null $metadata Filter by metadata key-value pairs. It uses the `deepObject` style, e.g. `?metadata[key]=value`.
     * @return Page<Subscription>
     */
    public function listPaginated(
        string|array|null $organizationId = null,
        string|array|null $productId = null,
        string|array|null $customerId = null,
        string|array|null $externalCustomerId = null,
        string|array|null $discountId = null,
        ?bool $active = null,
        SubscriptionStatus|array|null $status = null,
        ?bool $cancelAtPeriodEnd = null,
        CustomerCancellationReason|array|null $customerCancellationReason = null,
        ?string $canceledAtAfter = null,
        ?string $canceledAtBefore = null,
        ?int $limit = null,
        ?array $sorting = null,
        ?array $metadata = null,
    ): Page {
        /** @var \Closure(int): array{0: list<Subscription>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($organizationId, $productId, $customerId, $externalCustomerId, $discountId, $active, $status, $cancelAtPeriodEnd, $customerCancellationReason, $canceledAtAfter, $canceledAtBefore, $limit, $sorting, $metadata): array {
            $result = $this->list(
                organizationId: $organizationId,
                productId: $productId,
                customerId: $customerId,
                externalCustomerId: $externalCustomerId,
                discountId: $discountId,
                active: $active,
                status: $status,
                cancelAtPeriodEnd: $cancelAtPeriodEnd,
                customerCancellationReason: $customerCancellationReason,
                canceledAtAfter: $canceledAtAfter,
                canceledAtBefore: $canceledAtBefore,
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
     * Create a subscription programmatically.
     *
     * This endpoint only allows to create subscription on free products.
     * For paid products, use the checkout flow.
     *
     * No initial order will be created and no confirmation email will be sent.
     *
     * **Scopes**: `subscriptions:write`
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function create(
        SubscriptionCreateCustomer|SubscriptionCreateExternalCustomer $body,
    ): Subscription {
        $response = $this->transport->request(
            'POST',
            '/v1/subscriptions/',
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

        $result = Subscription::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Export subscriptions as a CSV file.
     *
     * **Scopes**: `subscriptions:read` `subscriptions:write`
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function export(
        string|array|null $organizationId = null,
    ): string {
        $response = $this->transport->request(
            'GET',
            '/v1/subscriptions/export',
            [
            ],
            [
                'organization_id' => Json::encode($organizationId),
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
     * Get a subscription by ID.
     *
     * **Scopes**: `subscriptions:read` `subscriptions:write`
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
    ): Subscription {
        $response = $this->transport->request(
            'GET',
            '/v1/subscriptions/{id}',
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

        $result = Subscription::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Revoke a subscription, i.e cancel immediately.
     *
     * **Scopes**: `subscriptions:write`
     *
     * @param $id The subscription ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\AlreadyCanceledSubscription on HTTP 403
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\SubscriptionLocked on HTTP 409
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function revoke(
        string $id,
    ): Subscription {
        $response = $this->transport->request(
            'DELETE',
            '/v1/subscriptions/{id}',
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
                409 => \Pago\V2026_04\Errors\SubscriptionLocked::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = Subscription::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Update a subscription.
     *
     * **Scopes**: `subscriptions:write`
     *
     * @param $id The subscription ID.
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\PaymentFailed on HTTP 402
     * @throws \Pago\V2026_04\Errors\AlreadyCanceledSubscription on HTTP 403
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\SubscriptionLocked on HTTP 409
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function update(
        string $id,
        SubscriptionUpdate $body,
    ): Subscription {
        $response = $this->transport->request(
            'PATCH',
            '/v1/subscriptions/{id}',
            [
                'id' => Json::encode($id),
            ],
            [
            ],
            Json::encode($body),
            'json',
            [
                402 => \Pago\V2026_04\Errors\PaymentFailed::class,
                403 => \Pago\V2026_04\Errors\AlreadyCanceledSubscription::class,
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                409 => \Pago\V2026_04\Errors\SubscriptionLocked::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = Subscription::fromArray(Json::toMap($response));

        return $result;
    }
}