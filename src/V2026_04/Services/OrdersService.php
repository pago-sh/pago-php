<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\ListResourceOrder;
use Pago\V2026_04\Models\Order;
use Pago\V2026_04\Models\OrderCreate;
use Pago\V2026_04\Models\OrderFinalize;
use Pago\V2026_04\Models\OrderInvoice;
use Pago\V2026_04\Models\OrderReceipt;
use Pago\V2026_04\Models\OrderSortProperty;
use Pago\V2026_04\Models\OrderUpdate;
use Pago\V2026_04\Models\ProductBillingType;

/**
 * Orders operations.
 */
final class OrdersService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * List orders.
     *
     * **Scopes**: `orders:read`
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $productId Filter by product ID.
     * @param ProductBillingType|list<ProductBillingType>|null $productBillingType Filter by product billing type. `recurring` will filter data corresponding to subscriptions creations or renewals. `one_time` will filter data corresponding to one-time purchases.
     * @param string|list<string>|null $discountId Filter by discount ID.
     * @param string|list<string>|null $customerId Filter by customer ID.
     * @param string|list<string>|null $externalCustomerId Filter by customer external ID.
     * @param string|list<string>|null $checkoutId Filter by checkout ID.
     * @param string|list<string>|null $subscriptionId Filter by subscription ID.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<OrderSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
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
        ProductBillingType|array|null $productBillingType = null,
        string|array|null $discountId = null,
        string|array|null $customerId = null,
        string|array|null $externalCustomerId = null,
        string|array|null $checkoutId = null,
        string|array|null $subscriptionId = null,
        ?int $page = null,
        ?int $limit = null,
        ?array $sorting = null,
        ?array $metadata = null,
    ): ListResourceOrder {
        $response = $this->transport->request(
            'GET',
            '/v1/orders/',
            [
            ],
            [
                'organization_id' => Json::encode($organizationId),
                'product_id' => Json::encode($productId),
                'product_billing_type' => Json::encode($productBillingType),
                'discount_id' => Json::encode($discountId),
                'customer_id' => Json::encode($customerId),
                'external_customer_id' => Json::encode($externalCustomerId),
                'checkout_id' => Json::encode($checkoutId),
                'subscription_id' => Json::encode($subscriptionId),
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

        $result = ListResourceOrder::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List orders.
     *
     * Lazily iterates every page returned by {@see self::list()}.
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $productId Filter by product ID.
     * @param ProductBillingType|list<ProductBillingType>|null $productBillingType Filter by product billing type. `recurring` will filter data corresponding to subscriptions creations or renewals. `one_time` will filter data corresponding to one-time purchases.
     * @param string|list<string>|null $discountId Filter by discount ID.
     * @param string|list<string>|null $customerId Filter by customer ID.
     * @param string|list<string>|null $externalCustomerId Filter by customer external ID.
     * @param string|list<string>|null $checkoutId Filter by checkout ID.
     * @param string|list<string>|null $subscriptionId Filter by subscription ID.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<OrderSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @param array<string, string|int|bool|list<string>|list<int>|list<bool>>|null $metadata Filter by metadata key-value pairs. It uses the `deepObject` style, e.g. `?metadata[key]=value`.
     * @return Page<Order>
     */
    public function listPaginated(
        string|array|null $organizationId = null,
        string|array|null $productId = null,
        ProductBillingType|array|null $productBillingType = null,
        string|array|null $discountId = null,
        string|array|null $customerId = null,
        string|array|null $externalCustomerId = null,
        string|array|null $checkoutId = null,
        string|array|null $subscriptionId = null,
        ?int $limit = null,
        ?array $sorting = null,
        ?array $metadata = null,
    ): Page {
        /** @var \Closure(int): array{0: list<Order>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($organizationId, $productId, $productBillingType, $discountId, $customerId, $externalCustomerId, $checkoutId, $subscriptionId, $limit, $sorting, $metadata): array {
            $result = $this->list(
                organizationId: $organizationId,
                productId: $productId,
                productBillingType: $productBillingType,
                discountId: $discountId,
                customerId: $customerId,
                externalCustomerId: $externalCustomerId,
                checkoutId: $checkoutId,
                subscriptionId: $subscriptionId,
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
     * Create a draft order for an off-session charge against a saved payment
     * method. The order is created with `status=draft` and no invoice number;
     * call `POST /v1/orders/{id}/finalize` to attempt the charge.
     *
     * The organization must have the `off_session_charges_enabled` feature flag.
     *
     * **Scopes**: `orders:write`
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function create(
        OrderCreate $body,
    ): Order {
        $response = $this->transport->request(
            'POST',
            '/v1/orders/',
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

        $result = Order::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Export orders as a CSV file.
     *
     * **Scopes**: `orders:read`
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $productId Filter by product ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function export(
        string|array|null $organizationId = null,
        string|array|null $productId = null,
    ): string {
        $response = $this->transport->request(
            'GET',
            '/v1/orders/export',
            [
            ],
            [
                'organization_id' => Json::encode($organizationId),
                'product_id' => Json::encode($productId),
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
     * Get an order by ID.
     *
     * **Scopes**: `orders:read`
     *
     * @param $id The order ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function get(
        string $id,
    ): Order {
        $response = $this->transport->request(
            'GET',
            '/v1/orders/{id}',
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

        $result = Order::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Update an order.
     *
     * **Scopes**: `orders:write`
     *
     * @param $id The order ID.
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
        OrderUpdate $body,
    ): Order {
        $response = $this->transport->request(
            'PATCH',
            '/v1/orders/{id}',
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

        $result = Order::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Finalize a draft order and synchronously attempt an off-session charge.
     *
     * On success, the order transitions to `paid` and benefit grants fire
     * before the response returns. On failure (decline, missing payment method,
     * SCA challenge), the order stays in `draft` and a 4xx error is returned.
     *
     * The request fails with 412 if the order is not in `draft` status.
     *
     * **Scopes**: `orders:write`
     *
     * @param $id The order ID.
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\Finalize402Error on HTTP 402
     * @throws \Pago\V2026_04\Errors\Finalize403Error on HTTP 403
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\OrderNotDraft on HTTP 412
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function finalize(
        string $id,
        OrderFinalize $body,
    ): Order {
        $response = $this->transport->request(
            'POST',
            '/v1/orders/{id}/finalize',
            [
                'id' => Json::encode($id),
            ],
            [
            ],
            Json::encode($body),
            'json',
            [
                402 => \Pago\V2026_04\Errors\Finalize402Error::class,
                403 => \Pago\V2026_04\Errors\Finalize403Error::class,
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                412 => \Pago\V2026_04\Errors\OrderNotDraft::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = Order::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get an order's invoice data.
     *
     * **Scopes**: `orders:read`
     *
     * @param $id The order ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function invoice(
        string $id,
    ): OrderInvoice {
        $response = $this->transport->request(
            'GET',
            '/v1/orders/{id}/invoice',
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

        $result = OrderInvoice::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Trigger generation of an order's invoice.
     *
     * **Scopes**: `orders:read`
     *
     * @param $id The order ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\OrderNotEligibleForInvoice on HTTP 409
     * @throws \Pago\V2026_04\Errors\MissingInvoiceBillingDetails on HTTP 422
     */
    public function generateInvoice(
        string $id,
    ): mixed {
        $response = $this->transport->request(
            'POST',
            '/v1/orders/{id}/invoice',
            [
                'id' => Json::encode($id),
            ],
            [
            ],
            null,
            'json',
            [
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                409 => \Pago\V2026_04\Errors\OrderNotEligibleForInvoice::class,
                422 => \Pago\V2026_04\Errors\MissingInvoiceBillingDetails::class,
            ],
        );

        $result = $response;

        return $result;
    }

    /**
     * Get a presigned URL to download an order's receipt PDF.
     *
     * **Scopes**: `orders:read`
     *
     * @param $id The order ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function receipt(
        string $id,
    ): OrderReceipt {
        $response = $this->transport->request(
            'GET',
            '/v1/orders/{id}/receipt',
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

        $result = OrderReceipt::fromArray(Json::toMap($response));

        return $result;
    }
}