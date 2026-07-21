<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services\CustomerPortal;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\CustomerCustomerMeter;
use Pago\V2026_04\Models\CustomerCustomerMeterSortProperty;
use Pago\V2026_04\Models\ListResourceCustomerCustomerMeter;

/**
 * CustomerMeters operations.
 */
final class CustomerMetersService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * List meters of the authenticated customer.
     *
     * **Scopes**: `customer_portal:read` `customer_portal:write`
     *
     * @param string|list<string>|null $meterId Filter by meter ID.
     * @param string|null $query Filter by meter name.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<CustomerCustomerMeterSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function list(
        string|array|null $meterId = null,
        ?string $query = null,
        ?int $page = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): ListResourceCustomerCustomerMeter {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-portal/meters/',
            [
            ],
            [
                'meter_id' => Json::encode($meterId),
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

        $result = ListResourceCustomerCustomerMeter::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List meters of the authenticated customer.
     *
     * Lazily iterates every page returned by {@see self::list()}.
     *
     * @param string|list<string>|null $meterId Filter by meter ID.
     * @param string|null $query Filter by meter name.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<CustomerCustomerMeterSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @return Page<CustomerCustomerMeter>
     */
    public function listPaginated(
        string|array|null $meterId = null,
        ?string $query = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): Page {
        /** @var \Closure(int): array{0: list<CustomerCustomerMeter>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($meterId, $query, $limit, $sorting): array {
            $result = $this->list(
                meterId: $meterId,
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
     * Get a meter by ID for the authenticated customer.
     *
     * **Scopes**: `customer_portal:read` `customer_portal:write`
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
    ): CustomerCustomerMeter {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-portal/meters/{id}',
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

        $result = CustomerCustomerMeter::fromArray(Json::toMap($response));

        return $result;
    }
}