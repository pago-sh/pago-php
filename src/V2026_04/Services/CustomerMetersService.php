<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\CustomerMeter;
use Pago\V2026_04\Models\CustomerMeterSortProperty;
use Pago\V2026_04\Models\ListResourceCustomerMeter;

/**
 * CustomerMeters operations.
 */
final class CustomerMetersService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * List customer meters.
     *
     * **Scopes**: `customer_meters:read`
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $customerId Filter by customer ID.
     * @param string|list<string>|null $externalCustomerId Filter by external customer ID.
     * @param string|list<string>|null $meterId Filter by meter ID.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<CustomerMeterSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
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
        string|array|null $meterId = null,
        ?int $page = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): ListResourceCustomerMeter {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-meters/',
            [
            ],
            [
                'organization_id' => Json::encode($organizationId),
                'customer_id' => Json::encode($customerId),
                'external_customer_id' => Json::encode($externalCustomerId),
                'meter_id' => Json::encode($meterId),
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

        $result = ListResourceCustomerMeter::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List customer meters.
     *
     * Lazily iterates every page returned by {@see self::list()}.
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $customerId Filter by customer ID.
     * @param string|list<string>|null $externalCustomerId Filter by external customer ID.
     * @param string|list<string>|null $meterId Filter by meter ID.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<CustomerMeterSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @return Page<CustomerMeter>
     */
    public function listPaginated(
        string|array|null $organizationId = null,
        string|array|null $customerId = null,
        string|array|null $externalCustomerId = null,
        string|array|null $meterId = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): Page {
        /** @var \Closure(int): array{0: list<CustomerMeter>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($organizationId, $customerId, $externalCustomerId, $meterId, $limit, $sorting): array {
            $result = $this->list(
                organizationId: $organizationId,
                customerId: $customerId,
                externalCustomerId: $externalCustomerId,
                meterId: $meterId,
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
     * Get a customer meter by ID.
     *
     * **Scopes**: `customer_meters:read`
     *
     * @param $id The customer meter ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function get(
        string $id,
    ): CustomerMeter {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-meters/{id}',
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

        $result = CustomerMeter::fromArray(Json::toMap($response));

        return $result;
    }
}