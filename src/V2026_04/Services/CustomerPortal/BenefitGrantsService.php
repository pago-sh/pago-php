<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services\CustomerPortal;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\BenefitType;
use Pago\V2026_04\Models\CustomerBenefitGrant;
use Pago\V2026_04\Models\CustomerBenefitGrantFactory;
use Pago\V2026_04\Models\CustomerBenefitGrantSortProperty;
use Pago\V2026_04\Models\CustomerBenefitGrantUpdate;
use Pago\V2026_04\Models\CustomerBenefitGrantUpdateFactory;
use Pago\V2026_04\Models\ListResourceCustomerBenefitGrant;

/**
 * BenefitGrants operations.
 */
final class BenefitGrantsService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * List benefits grants of the authenticated customer.
     *
     * **Scopes**: `customer_portal:read` `customer_portal:write`
     *
     * @param string|null $query Filter by benefit description.
     * @param BenefitType|list<BenefitType>|null $type Filter by benefit type.
     * @param string|list<string>|null $benefitId Filter by benefit ID.
     * @param string|list<string>|null $checkoutId Filter by checkout ID.
     * @param string|list<string>|null $orderId Filter by order ID.
     * @param string|list<string>|null $subscriptionId Filter by subscription ID.
     * @param string|list<string>|null $memberId Filter by member ID.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<CustomerBenefitGrantSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function list(
        ?string $query = null,
        BenefitType|array|null $type = null,
        string|array|null $benefitId = null,
        string|array|null $checkoutId = null,
        string|array|null $orderId = null,
        string|array|null $subscriptionId = null,
        string|array|null $memberId = null,
        ?int $page = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): ListResourceCustomerBenefitGrant {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-portal/benefit-grants/',
            [
            ],
            [
                'query' => Json::encode($query),
                'type' => Json::encode($type),
                'benefit_id' => Json::encode($benefitId),
                'checkout_id' => Json::encode($checkoutId),
                'order_id' => Json::encode($orderId),
                'subscription_id' => Json::encode($subscriptionId),
                'member_id' => Json::encode($memberId),
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

        $result = ListResourceCustomerBenefitGrant::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List benefits grants of the authenticated customer.
     *
     * Lazily iterates every page returned by {@see self::list()}.
     *
     * @param string|null $query Filter by benefit description.
     * @param BenefitType|list<BenefitType>|null $type Filter by benefit type.
     * @param string|list<string>|null $benefitId Filter by benefit ID.
     * @param string|list<string>|null $checkoutId Filter by checkout ID.
     * @param string|list<string>|null $orderId Filter by order ID.
     * @param string|list<string>|null $subscriptionId Filter by subscription ID.
     * @param string|list<string>|null $memberId Filter by member ID.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<CustomerBenefitGrantSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @return Page<CustomerBenefitGrant>
     */
    public function listPaginated(
        ?string $query = null,
        BenefitType|array|null $type = null,
        string|array|null $benefitId = null,
        string|array|null $checkoutId = null,
        string|array|null $orderId = null,
        string|array|null $subscriptionId = null,
        string|array|null $memberId = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): Page {
        /** @var \Closure(int): array{0: list<CustomerBenefitGrant>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($query, $type, $benefitId, $checkoutId, $orderId, $subscriptionId, $memberId, $limit, $sorting): array {
            $result = $this->list(
                query: $query,
                type: $type,
                benefitId: $benefitId,
                checkoutId: $checkoutId,
                orderId: $orderId,
                subscriptionId: $subscriptionId,
                memberId: $memberId,
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
     * Get a benefit grant by ID for the authenticated customer.
     *
     * **Scopes**: `customer_portal:read` `customer_portal:write`
     *
     * @param $id The benefit grant ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function get(
        string $id,
    ): CustomerBenefitGrant {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-portal/benefit-grants/{id}',
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

        $result = CustomerBenefitGrantFactory::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Update a benefit grant for the authenticated customer.
     *
     * **Scopes**: `customer_portal:write`
     *
     * @param $id The benefit grant ID.
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\NotPermitted on HTTP 403
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function update(
        string $id,
        CustomerBenefitGrantUpdate $body,
    ): CustomerBenefitGrant {
        $response = $this->transport->request(
            'PATCH',
            '/v1/customer-portal/benefit-grants/{id}',
            [
                'id' => Json::encode($id),
            ],
            [
            ],
            Json::encode($body),
            'json',
            [
                403 => \Pago\V2026_04\Errors\NotPermitted::class,
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = CustomerBenefitGrantFactory::fromArray(Json::toMap($response));

        return $result;
    }
}