<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\Checkout;
use Pago\V2026_04\Models\CheckoutConfirmStripe;
use Pago\V2026_04\Models\CheckoutCreate;
use Pago\V2026_04\Models\CheckoutPublic;
use Pago\V2026_04\Models\CheckoutPublicConfirmed;
use Pago\V2026_04\Models\CheckoutSortProperty;
use Pago\V2026_04\Models\CheckoutStatus;
use Pago\V2026_04\Models\CheckoutUpdate;
use Pago\V2026_04\Models\CheckoutUpdatePublic;
use Pago\V2026_04\Models\ListResourceCheckout;

/**
 * Checkouts operations.
 */
final class CheckoutsService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * List checkout sessions.
     *
     * **Scopes**: `checkouts:read` `checkouts:write`
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $productId Filter by product ID.
     * @param string|list<string>|null $customerId Filter by customer ID.
     * @param string|list<string>|null $externalCustomerId Filter by customer external ID.
     * @param CheckoutStatus|list<CheckoutStatus>|null $status Filter by checkout session status.
     * @param string|null $query Filter by customer email.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<CheckoutSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
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
        CheckoutStatus|array|null $status = null,
        ?string $query = null,
        ?int $page = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): ListResourceCheckout {
        $response = $this->transport->request(
            'GET',
            '/v1/checkouts/',
            [
            ],
            [
                'organization_id' => Json::encode($organizationId),
                'product_id' => Json::encode($productId),
                'customer_id' => Json::encode($customerId),
                'external_customer_id' => Json::encode($externalCustomerId),
                'status' => Json::encode($status),
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

        $result = ListResourceCheckout::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List checkout sessions.
     *
     * Lazily iterates every page returned by {@see self::list()}.
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $productId Filter by product ID.
     * @param string|list<string>|null $customerId Filter by customer ID.
     * @param string|list<string>|null $externalCustomerId Filter by customer external ID.
     * @param CheckoutStatus|list<CheckoutStatus>|null $status Filter by checkout session status.
     * @param string|null $query Filter by customer email.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<CheckoutSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @return Page<Checkout>
     */
    public function listPaginated(
        string|array|null $organizationId = null,
        string|array|null $productId = null,
        string|array|null $customerId = null,
        string|array|null $externalCustomerId = null,
        CheckoutStatus|array|null $status = null,
        ?string $query = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): Page {
        /** @var \Closure(int): array{0: list<Checkout>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($organizationId, $productId, $customerId, $externalCustomerId, $status, $query, $limit, $sorting): array {
            $result = $this->list(
                organizationId: $organizationId,
                productId: $productId,
                customerId: $customerId,
                externalCustomerId: $externalCustomerId,
                status: $status,
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
     * Create a checkout session.
     *
     * **Scopes**: `checkouts:write`
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function create(
        CheckoutCreate $body,
    ): Checkout {
        $response = $this->transport->request(
            'POST',
            '/v1/checkouts/',
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

        $result = Checkout::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get a checkout session by ID.
     *
     * **Scopes**: `checkouts:read` `checkouts:write`
     *
     * @param $id The checkout session ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function get(
        string $id,
    ): Checkout {
        $response = $this->transport->request(
            'GET',
            '/v1/checkouts/{id}',
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

        $result = Checkout::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Update a checkout session.
     *
     * **Scopes**: `checkouts:write`
     *
     * @param $id The checkout session ID.
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\Update403Error on HTTP 403
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function update(
        string $id,
        CheckoutUpdate $body,
    ): Checkout {
        $response = $this->transport->request(
            'PATCH',
            '/v1/checkouts/{id}',
            [
                'id' => Json::encode($id),
            ],
            [
            ],
            Json::encode($body),
            'json',
            [
                403 => \Pago\V2026_04\Errors\Update403Error::class,
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = Checkout::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get a checkout session by client secret.
     *
     * @param $clientSecret The checkout session client secret.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\ExpiredCheckoutError on HTTP 410
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function clientGet(
        string $clientSecret,
    ): CheckoutPublic {
        $response = $this->transport->request(
            'GET',
            '/v1/checkouts/client/{client_secret}',
            [
                'client_secret' => Json::encode($clientSecret),
            ],
            [
            ],
            null,
            'json',
            [
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                410 => \Pago\V2026_04\Errors\ExpiredCheckoutError::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = CheckoutPublic::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Update a checkout session by client secret.
     *
     * @param $clientSecret The checkout session client secret.
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ClientUpdate403Error on HTTP 403
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\ExpiredCheckoutError on HTTP 410
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function clientUpdate(
        string $clientSecret,
        CheckoutUpdatePublic $body,
    ): CheckoutPublic {
        $response = $this->transport->request(
            'PATCH',
            '/v1/checkouts/client/{client_secret}',
            [
                'client_secret' => Json::encode($clientSecret),
            ],
            [
            ],
            Json::encode($body),
            'json',
            [
                403 => \Pago\V2026_04\Errors\ClientUpdate403Error::class,
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                410 => \Pago\V2026_04\Errors\ExpiredCheckoutError::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = CheckoutPublic::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Confirm a checkout session by client secret.
     *
     * Orders and subscriptions will be processed.
     *
     * @param $clientSecret The checkout session client secret.
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\PaymentError on HTTP 400
     * @throws \Pago\V2026_04\Errors\ClientConfirm403Error on HTTP 403
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\ExpiredCheckoutError on HTTP 410
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function clientConfirm(
        string $clientSecret,
        CheckoutConfirmStripe $body,
    ): CheckoutPublicConfirmed {
        $response = $this->transport->request(
            'POST',
            '/v1/checkouts/client/{client_secret}/confirm',
            [
                'client_secret' => Json::encode($clientSecret),
            ],
            [
            ],
            Json::encode($body),
            'json',
            [
                400 => \Pago\V2026_04\Errors\PaymentError::class,
                403 => \Pago\V2026_04\Errors\ClientConfirm403Error::class,
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                410 => \Pago\V2026_04\Errors\ExpiredCheckoutError::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = CheckoutPublicConfirmed::fromArray(Json::toMap($response));

        return $result;
    }
}