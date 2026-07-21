<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\Discount;
use Pago\V2026_04\Models\DiscountCreate;
use Pago\V2026_04\Models\DiscountCreateFactory;
use Pago\V2026_04\Models\DiscountFactory;
use Pago\V2026_04\Models\DiscountSortProperty;
use Pago\V2026_04\Models\DiscountUpdate;
use Pago\V2026_04\Models\ListResourceDiscount;

/**
 * Discounts operations.
 */
final class DiscountsService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * List discounts.
     *
     * **Scopes**: `discounts:read` `discounts:write`
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|null $query Filter by name.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<DiscountSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function list(
        string|array|null $organizationId = null,
        ?string $query = null,
        ?int $page = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): ListResourceDiscount {
        $response = $this->transport->request(
            'GET',
            '/v1/discounts/',
            [
            ],
            [
                'organization_id' => Json::encode($organizationId),
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

        $result = ListResourceDiscount::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List discounts.
     *
     * Lazily iterates every page returned by {@see self::list()}.
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|null $query Filter by name.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<DiscountSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @return Page<Discount>
     */
    public function listPaginated(
        string|array|null $organizationId = null,
        ?string $query = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): Page {
        /** @var \Closure(int): array{0: list<Discount>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($organizationId, $query, $limit, $sorting): array {
            $result = $this->list(
                organizationId: $organizationId,
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
     * Create a discount.
     *
     * **Scopes**: `discounts:write`
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function create(
        DiscountCreate $body,
    ): Discount {
        $response = $this->transport->request(
            'POST',
            '/v1/discounts/',
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

        $result = DiscountFactory::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get a discount by ID.
     *
     * **Scopes**: `discounts:read` `discounts:write`
     *
     * @param $id The discount ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function get(
        string $id,
    ): Discount {
        $response = $this->transport->request(
            'GET',
            '/v1/discounts/{id}',
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

        $result = DiscountFactory::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Delete a discount.
     *
     * **Scopes**: `discounts:write`
     *
     * @param $id The discount ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function delete(
        string $id,
    ): void {
        $this->transport->request(
            'DELETE',
            '/v1/discounts/{id}',
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
     * Update a discount.
     *
     * **Scopes**: `discounts:write`
     *
     * @param $id The discount ID.
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
        DiscountUpdate $body,
    ): Discount {
        $response = $this->transport->request(
            'PATCH',
            '/v1/discounts/{id}',
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

        $result = DiscountFactory::fromArray(Json::toMap($response));

        return $result;
    }
}