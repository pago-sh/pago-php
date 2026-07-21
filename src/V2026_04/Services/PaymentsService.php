<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\ListResourcePayment;
use Pago\V2026_04\Models\Payment;
use Pago\V2026_04\Models\PaymentFactory;
use Pago\V2026_04\Models\PaymentSortProperty;
use Pago\V2026_04\Models\PaymentStatus;

/**
 * Payments operations.
 */
final class PaymentsService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * List payments.
     *
     * **Scopes**: `payments:read`
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $checkoutId Filter by checkout ID.
     * @param string|list<string>|null $orderId Filter by order ID.
     * @param string|list<string>|null $customerId Filter by customer ID.
     * @param PaymentStatus|list<PaymentStatus>|null $status Filter by payment status.
     * @param string|list<string>|null $method Filter by payment method.
     * @param string|list<string>|null $customerEmail Filter by customer email.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<PaymentSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function list(
        string|array|null $organizationId = null,
        string|array|null $checkoutId = null,
        string|array|null $orderId = null,
        string|array|null $customerId = null,
        PaymentStatus|array|null $status = null,
        string|array|null $method = null,
        string|array|null $customerEmail = null,
        ?int $page = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): ListResourcePayment {
        $response = $this->transport->request(
            'GET',
            '/v1/payments/',
            [
            ],
            [
                'organization_id' => Json::encode($organizationId),
                'checkout_id' => Json::encode($checkoutId),
                'order_id' => Json::encode($orderId),
                'customer_id' => Json::encode($customerId),
                'status' => Json::encode($status),
                'method' => Json::encode($method),
                'customer_email' => Json::encode($customerEmail),
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

        $result = ListResourcePayment::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List payments.
     *
     * Lazily iterates every page returned by {@see self::list()}.
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $checkoutId Filter by checkout ID.
     * @param string|list<string>|null $orderId Filter by order ID.
     * @param string|list<string>|null $customerId Filter by customer ID.
     * @param PaymentStatus|list<PaymentStatus>|null $status Filter by payment status.
     * @param string|list<string>|null $method Filter by payment method.
     * @param string|list<string>|null $customerEmail Filter by customer email.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<PaymentSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @return Page<Payment>
     */
    public function listPaginated(
        string|array|null $organizationId = null,
        string|array|null $checkoutId = null,
        string|array|null $orderId = null,
        string|array|null $customerId = null,
        PaymentStatus|array|null $status = null,
        string|array|null $method = null,
        string|array|null $customerEmail = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): Page {
        /** @var \Closure(int): array{0: list<Payment>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($organizationId, $checkoutId, $orderId, $customerId, $status, $method, $customerEmail, $limit, $sorting): array {
            $result = $this->list(
                organizationId: $organizationId,
                checkoutId: $checkoutId,
                orderId: $orderId,
                customerId: $customerId,
                status: $status,
                method: $method,
                customerEmail: $customerEmail,
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
     * Get a payment by ID.
     *
     * **Scopes**: `payments:read`
     *
     * @param $id The payment ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function get(
        string $id,
    ): Payment {
        $response = $this->transport->request(
            'GET',
            '/v1/payments/{id}',
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

        $result = PaymentFactory::fromArray(Json::toMap($response));

        return $result;
    }
}