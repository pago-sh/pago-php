<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\CheckoutLink;
use Pago\V2026_04\Models\CheckoutLinkCreate;
use Pago\V2026_04\Models\CheckoutLinkCreateFactory;
use Pago\V2026_04\Models\CheckoutLinkSortProperty;
use Pago\V2026_04\Models\CheckoutLinkUpdate;
use Pago\V2026_04\Models\ListResourceCheckoutLink;

/**
 * CheckoutLinks operations.
 */
final class CheckoutLinksService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * List checkout links.
     *
     * **Scopes**: `checkout_links:read` `checkout_links:write`
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $productId Filter by product ID.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<CheckoutLinkSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function list(
        string|array|null $organizationId = null,
        string|array|null $productId = null,
        ?int $page = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): ListResourceCheckoutLink {
        $response = $this->transport->request(
            'GET',
            '/v1/checkout-links/',
            [
            ],
            [
                'organization_id' => Json::encode($organizationId),
                'product_id' => Json::encode($productId),
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

        $result = ListResourceCheckoutLink::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List checkout links.
     *
     * Lazily iterates every page returned by {@see self::list()}.
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $productId Filter by product ID.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<CheckoutLinkSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @return Page<CheckoutLink>
     */
    public function listPaginated(
        string|array|null $organizationId = null,
        string|array|null $productId = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): Page {
        /** @var \Closure(int): array{0: list<CheckoutLink>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($organizationId, $productId, $limit, $sorting): array {
            $result = $this->list(
                organizationId: $organizationId,
                productId: $productId,
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
     * Create a checkout link.
     *
     * **Scopes**: `checkout_links:write`
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function create(
        CheckoutLinkCreate $body,
    ): CheckoutLink {
        $response = $this->transport->request(
            'POST',
            '/v1/checkout-links/',
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

        $result = CheckoutLink::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get a checkout link by ID.
     *
     * **Scopes**: `checkout_links:read` `checkout_links:write`
     *
     * @param $id The checkout link ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function get(
        string $id,
    ): CheckoutLink {
        $response = $this->transport->request(
            'GET',
            '/v1/checkout-links/{id}',
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

        $result = CheckoutLink::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Delete a checkout link.
     *
     * **Scopes**: `checkout_links:write`
     *
     * @param $id The checkout link ID.
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
            '/v1/checkout-links/{id}',
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
     * Update a checkout link.
     *
     * **Scopes**: `checkout_links:write`
     *
     * @param $id The checkout link ID.
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
        CheckoutLinkUpdate $body,
    ): CheckoutLink {
        $response = $this->transport->request(
            'PATCH',
            '/v1/checkout-links/{id}',
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

        $result = CheckoutLink::fromArray(Json::toMap($response));

        return $result;
    }
}