<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\ListResourceRefund;
use Pago\V2026_04\Models\Refund;
use Pago\V2026_04\Models\RefundCreate;
use Pago\V2026_04\Models\RefundSortProperty;

/**
 * Refunds operations.
 */
final class RefundsService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * List refunds.
     *
     * **Scopes**: `refunds:read` `refunds:write`
     *
     * @param string|list<string>|null $id Filter by refund ID.
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $orderId Filter by order ID.
     * @param string|list<string>|null $subscriptionId Filter by subscription ID.
     * @param string|list<string>|null $customerId Filter by customer ID.
     * @param string|list<string>|null $externalCustomerId Filter by customer external ID.
     * @param bool|null $succeeded Filter by `succeeded`.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<RefundSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function list(
        string|array|null $id = null,
        string|array|null $organizationId = null,
        string|array|null $orderId = null,
        string|array|null $subscriptionId = null,
        string|array|null $customerId = null,
        string|array|null $externalCustomerId = null,
        ?bool $succeeded = null,
        ?int $page = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): ListResourceRefund {
        $response = $this->transport->request(
            'GET',
            '/v1/refunds/',
            [
            ],
            [
                'id' => Json::encode($id),
                'organization_id' => Json::encode($organizationId),
                'order_id' => Json::encode($orderId),
                'subscription_id' => Json::encode($subscriptionId),
                'customer_id' => Json::encode($customerId),
                'external_customer_id' => Json::encode($externalCustomerId),
                'succeeded' => Json::encode($succeeded),
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

        $result = ListResourceRefund::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List refunds.
     *
     * Lazily iterates every page returned by {@see self::list()}.
     *
     * @param string|list<string>|null $id Filter by refund ID.
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $orderId Filter by order ID.
     * @param string|list<string>|null $subscriptionId Filter by subscription ID.
     * @param string|list<string>|null $customerId Filter by customer ID.
     * @param string|list<string>|null $externalCustomerId Filter by customer external ID.
     * @param bool|null $succeeded Filter by `succeeded`.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<RefundSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @return Page<Refund>
     */
    public function listPaginated(
        string|array|null $id = null,
        string|array|null $organizationId = null,
        string|array|null $orderId = null,
        string|array|null $subscriptionId = null,
        string|array|null $customerId = null,
        string|array|null $externalCustomerId = null,
        ?bool $succeeded = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): Page {
        /** @var \Closure(int): array{0: list<Refund>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($id, $organizationId, $orderId, $subscriptionId, $customerId, $externalCustomerId, $succeeded, $limit, $sorting): array {
            $result = $this->list(
                id: $id,
                organizationId: $organizationId,
                orderId: $orderId,
                subscriptionId: $subscriptionId,
                customerId: $customerId,
                externalCustomerId: $externalCustomerId,
                succeeded: $succeeded,
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
     * Create a refund.
     *
     * **Scopes**: `refunds:write`
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\RefundedAlready on HTTP 403
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function create(
        RefundCreate $body,
    ): Refund {
        $response = $this->transport->request(
            'POST',
            '/v1/refunds/',
            [
            ],
            [
            ],
            Json::encode($body),
            'json',
            [
                403 => \Pago\V2026_04\Errors\RefundedAlready::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = Refund::fromArray(Json::toMap($response));

        return $result;
    }
}