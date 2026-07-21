<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services\CustomerPortal;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\CustomerOrder;
use Pago\V2026_04\Models\CustomerOrderConfirmPayment;
use Pago\V2026_04\Models\CustomerOrderInvoice;
use Pago\V2026_04\Models\CustomerOrderPaymentConfirmation;
use Pago\V2026_04\Models\CustomerOrderPaymentStatus;
use Pago\V2026_04\Models\CustomerOrderReceipt;
use Pago\V2026_04\Models\CustomerOrderSortProperty;
use Pago\V2026_04\Models\CustomerOrderUpdate;
use Pago\V2026_04\Models\ListResourceCustomerOrder;
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
     * List orders of the authenticated customer.
     *
     * @param string|list<string>|null $productId Filter by product ID.
     * @param ProductBillingType|list<ProductBillingType>|null $productBillingType Filter by product billing type. `recurring` will filter data corresponding to subscriptions creations or renewals. `one_time` will filter data corresponding to one-time purchases.
     * @param string|list<string>|null $subscriptionId Filter by subscription ID.
     * @param string|null $query Search by product or organization name.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<CustomerOrderSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function list(
        string|array|null $productId = null,
        ProductBillingType|array|null $productBillingType = null,
        string|array|null $subscriptionId = null,
        ?string $query = null,
        ?int $page = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): ListResourceCustomerOrder {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-portal/orders/',
            [
            ],
            [
                'product_id' => Json::encode($productId),
                'product_billing_type' => Json::encode($productBillingType),
                'subscription_id' => Json::encode($subscriptionId),
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

        $result = ListResourceCustomerOrder::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List orders of the authenticated customer.
     *
     * Lazily iterates every page returned by {@see self::list()}.
     *
     * @param string|list<string>|null $productId Filter by product ID.
     * @param ProductBillingType|list<ProductBillingType>|null $productBillingType Filter by product billing type. `recurring` will filter data corresponding to subscriptions creations or renewals. `one_time` will filter data corresponding to one-time purchases.
     * @param string|list<string>|null $subscriptionId Filter by subscription ID.
     * @param string|null $query Search by product or organization name.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<CustomerOrderSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @return Page<CustomerOrder>
     */
    public function listPaginated(
        string|array|null $productId = null,
        ProductBillingType|array|null $productBillingType = null,
        string|array|null $subscriptionId = null,
        ?string $query = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): Page {
        /** @var \Closure(int): array{0: list<CustomerOrder>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($productId, $productBillingType, $subscriptionId, $query, $limit, $sorting): array {
            $result = $this->list(
                productId: $productId,
                productBillingType: $productBillingType,
                subscriptionId: $subscriptionId,
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
     * Get an order by ID for the authenticated customer.
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
    ): CustomerOrder {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-portal/orders/{id}',
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

        $result = CustomerOrder::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Update an order for the authenticated customer.
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
        CustomerOrderUpdate $body,
    ): CustomerOrder {
        $response = $this->transport->request(
            'PATCH',
            '/v1/customer-portal/orders/{id}',
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

        $result = CustomerOrder::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get an order's invoice data.
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
    ): CustomerOrderInvoice {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-portal/orders/{id}/invoice',
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

        $result = CustomerOrderInvoice::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Trigger generation of an order's invoice.
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
            '/v1/customer-portal/orders/{id}/invoice',
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
    ): CustomerOrderReceipt {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-portal/orders/{id}/receipt',
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

        $result = CustomerOrderReceipt::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get the current payment status for an order.
     *
     * @param $id The order ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function getPaymentStatus(
        string $id,
    ): CustomerOrderPaymentStatus {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-portal/orders/{id}/payment-status',
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

        $result = CustomerOrderPaymentStatus::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Confirm a retry payment using a Stripe confirmation token.
     *
     * @param $id The order ID.
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\PaymentAlreadyInProgress on HTTP 409
     * @throws \Pago\V2026_04\Errors\OrderNotEligibleForRetry on HTTP 422
     * @throws \Pago\V2026_04\Errors\ManualRetryLimitExceeded on HTTP 429
     */
    public function confirmRetryPayment(
        string $id,
        CustomerOrderConfirmPayment $body,
    ): CustomerOrderPaymentConfirmation {
        $response = $this->transport->request(
            'POST',
            '/v1/customer-portal/orders/{id}/confirm-payment',
            [
                'id' => Json::encode($id),
            ],
            [
            ],
            Json::encode($body),
            'json',
            [
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                409 => \Pago\V2026_04\Errors\PaymentAlreadyInProgress::class,
                422 => \Pago\V2026_04\Errors\OrderNotEligibleForRetry::class,
                429 => \Pago\V2026_04\Errors\ManualRetryLimitExceeded::class,
            ],
        );

        $result = CustomerOrderPaymentConfirmation::fromArray(Json::toMap($response));

        return $result;
    }
}