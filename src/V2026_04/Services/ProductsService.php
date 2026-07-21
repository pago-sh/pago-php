<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\ListResourceProduct;
use Pago\V2026_04\Models\Product;
use Pago\V2026_04\Models\ProductBenefitsUpdate;
use Pago\V2026_04\Models\ProductCreate;
use Pago\V2026_04\Models\ProductCreateFactory;
use Pago\V2026_04\Models\ProductSortProperty;
use Pago\V2026_04\Models\ProductUpdate;
use Pago\V2026_04\Models\ProductVisibility;

/**
 * Products operations.
 */
final class ProductsService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * List products.
     *
     * **Scopes**: `products:read` `products:write`
     *
     * @param string|list<string>|null $id Filter by product ID.
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|null $query Filter by product name.
     * @param bool|null $isArchived Filter on archived products.
     * @param bool|null $isRecurring Filter on recurring products. If `true`, only subscriptions tiers are returned. If `false`, only one-time purchase products are returned.
     * @param string|list<string>|null $benefitId Filter products granting specific benefit.
     * @param list<ProductVisibility>|null $visibility Filter by visibility.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<ProductSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @param array<string, string|int|bool|list<string>|list<int>|list<bool>>|null $metadata Filter by metadata key-value pairs. It uses the `deepObject` style, e.g. `?metadata[key]=value`.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function list(
        string|array|null $id = null,
        string|array|null $organizationId = null,
        ?string $query = null,
        ?bool $isArchived = null,
        ?bool $isRecurring = null,
        string|array|null $benefitId = null,
        ?array $visibility = null,
        ?int $page = null,
        ?int $limit = null,
        ?array $sorting = null,
        ?array $metadata = null,
    ): ListResourceProduct {
        $response = $this->transport->request(
            'GET',
            '/v1/products/',
            [
            ],
            [
                'id' => Json::encode($id),
                'organization_id' => Json::encode($organizationId),
                'query' => Json::encode($query),
                'is_archived' => Json::encode($isArchived),
                'is_recurring' => Json::encode($isRecurring),
                'benefit_id' => Json::encode($benefitId),
                'visibility' => Json::encode($visibility),
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

        $result = ListResourceProduct::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List products.
     *
     * Lazily iterates every page returned by {@see self::list()}.
     *
     * @param string|list<string>|null $id Filter by product ID.
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|null $query Filter by product name.
     * @param bool|null $isArchived Filter on archived products.
     * @param bool|null $isRecurring Filter on recurring products. If `true`, only subscriptions tiers are returned. If `false`, only one-time purchase products are returned.
     * @param string|list<string>|null $benefitId Filter products granting specific benefit.
     * @param list<ProductVisibility>|null $visibility Filter by visibility.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<ProductSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @param array<string, string|int|bool|list<string>|list<int>|list<bool>>|null $metadata Filter by metadata key-value pairs. It uses the `deepObject` style, e.g. `?metadata[key]=value`.
     * @return Page<Product>
     */
    public function listPaginated(
        string|array|null $id = null,
        string|array|null $organizationId = null,
        ?string $query = null,
        ?bool $isArchived = null,
        ?bool $isRecurring = null,
        string|array|null $benefitId = null,
        ?array $visibility = null,
        ?int $limit = null,
        ?array $sorting = null,
        ?array $metadata = null,
    ): Page {
        /** @var \Closure(int): array{0: list<Product>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($id, $organizationId, $query, $isArchived, $isRecurring, $benefitId, $visibility, $limit, $sorting, $metadata): array {
            $result = $this->list(
                id: $id,
                organizationId: $organizationId,
                query: $query,
                isArchived: $isArchived,
                isRecurring: $isRecurring,
                benefitId: $benefitId,
                visibility: $visibility,
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
     * Create a product.
     *
     * **Scopes**: `products:write`
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function create(
        ProductCreate $body,
    ): Product {
        $response = $this->transport->request(
            'POST',
            '/v1/products/',
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

        $result = Product::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get a product by ID.
     *
     * **Scopes**: `products:read` `products:write`
     *
     * @param $id id
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function get(
        string $id,
    ): Product {
        $response = $this->transport->request(
            'GET',
            '/v1/products/{id}',
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

        $result = Product::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Update a product.
     *
     * **Scopes**: `products:write`
     *
     * @param $id id
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
        ProductUpdate $body,
    ): Product {
        $response = $this->transport->request(
            'PATCH',
            '/v1/products/{id}',
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

        $result = Product::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Update benefits granted by a product.
     *
     * **Scopes**: `products:write`
     *
     * @param $id id
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\NotPermitted on HTTP 403
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function updateBenefits(
        string $id,
        ProductBenefitsUpdate $body,
    ): Product {
        $response = $this->transport->request(
            'POST',
            '/v1/products/{id}/benefits',
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

        $result = Product::fromArray(Json::toMap($response));

        return $result;
    }
}