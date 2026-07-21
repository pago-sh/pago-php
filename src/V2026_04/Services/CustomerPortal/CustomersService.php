<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services\CustomerPortal;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\CustomerEmailUpdateRequest;
use Pago\V2026_04\Models\CustomerEmailUpdateVerifyRequest;
use Pago\V2026_04\Models\CustomerEmailUpdateVerifyResponse;
use Pago\V2026_04\Models\CustomerPaymentMethod;
use Pago\V2026_04\Models\CustomerPaymentMethodConfirm;
use Pago\V2026_04\Models\CustomerPaymentMethodCreate;
use Pago\V2026_04\Models\CustomerPaymentMethodCreateResponse;
use Pago\V2026_04\Models\CustomerPaymentMethodCreateResponseFactory;
use Pago\V2026_04\Models\CustomerPaymentMethodFactory;
use Pago\V2026_04\Models\CustomerPortalCustomer;
use Pago\V2026_04\Models\CustomerPortalCustomerUpdate;
use Pago\V2026_04\Models\ListResourceCustomerPaymentMethod;

/**
 * Customers operations.
 */
final class CustomersService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * Get authenticated customer.
     *
     * **Scopes**: `customer_portal:read` `customer_portal:write`
     *
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     */
    public function get(): CustomerPortalCustomer
    {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-portal/customers/me',
            [
            ],
            [
            ],
            null,
            'json',
            [
            ],
        );

        $result = CustomerPortalCustomer::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Update authenticated customer.
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function update(
        CustomerPortalCustomerUpdate $body,
    ): CustomerPortalCustomer {
        $response = $this->transport->request(
            'PATCH',
            '/v1/customer-portal/customers/me',
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

        $result = CustomerPortalCustomer::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get saved payment methods of the authenticated customer.
     *
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function listPaymentMethods(
        ?int $page = null,
        ?int $limit = null,
    ): ListResourceCustomerPaymentMethod {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-portal/customers/me/payment-methods',
            [
            ],
            [
                'page' => Json::encode($page),
                'limit' => Json::encode($limit),
            ],
            null,
            'json',
            [
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = ListResourceCustomerPaymentMethod::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get saved payment methods of the authenticated customer.
     *
     * Lazily iterates every page returned by {@see self::listPaymentMethods()}.
     *
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @return Page<CustomerPaymentMethod>
     */
    public function listPaymentMethodsPaginated(
        ?int $limit = null,
    ): Page {
        /** @var \Closure(int): array{0: list<CustomerPaymentMethod>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($limit): array {
            $result = $this->listPaymentMethods(
                page: $page,
                limit: $limit,
            );

            return [
                $result->items,
                $result->pagination->max_page,
            ];
        };

        return new Page($fetcher);
    }

    /**
     * Add a payment method to the authenticated customer.
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\PaymentMethodSetupFailed on HTTP 400
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function addPaymentMethod(
        CustomerPaymentMethodCreate $body,
    ): CustomerPaymentMethodCreateResponse {
        $response = $this->transport->request(
            'POST',
            '/v1/customer-portal/customers/me/payment-methods',
            [
            ],
            [
            ],
            Json::encode($body),
            'json',
            [
                400 => \Pago\V2026_04\Errors\PaymentMethodSetupFailed::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = CustomerPaymentMethodCreateResponseFactory::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Confirm a payment method for the authenticated customer.
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\CustomerNotReady on HTTP 400
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function confirmPaymentMethod(
        CustomerPaymentMethodConfirm $body,
    ): CustomerPaymentMethodCreateResponse {
        $response = $this->transport->request(
            'POST',
            '/v1/customer-portal/customers/me/payment-methods/confirm',
            [
            ],
            [
            ],
            Json::encode($body),
            'json',
            [
                400 => \Pago\V2026_04\Errors\CustomerNotReady::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = CustomerPaymentMethodCreateResponseFactory::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Delete a payment method from the authenticated customer.
     *
     * @param $id id
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\PaymentMethodInUseByActiveSubscription on HTTP 400
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function deletePaymentMethod(
        string $id,
    ): void {
        $this->transport->request(
            'DELETE',
            '/v1/customer-portal/customers/me/payment-methods/{id}',
            [
                'id' => Json::encode($id),
            ],
            [
            ],
            null,
            'none',
            [
                400 => \Pago\V2026_04\Errors\PaymentMethodInUseByActiveSubscription::class,
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );
    }

    /**
     * Request an email change for the authenticated customer.
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function requestEmailUpdate(
        CustomerEmailUpdateRequest $body,
    ): mixed {
        $response = $this->transport->request(
            'POST',
            '/v1/customer-portal/customers/me/email-update/request',
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

        $result = $response;

        return $result;
    }

    /**
     * Check if an email change verification token is still valid.
     *
     * @param $token token
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\CheckEmailUpdate401Error on HTTP 401
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function checkEmailUpdate(
        string $token,
    ): void {
        $this->transport->request(
            'GET',
            '/v1/customer-portal/customers/me/email-update/check',
            [
            ],
            [
                'token' => Json::encode($token),
            ],
            null,
            'none',
            [
                401 => \Pago\V2026_04\Errors\CheckEmailUpdate401Error::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );
    }

    /**
     * Verify an email change using the token from the verification email.
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\VerifyEmailUpdate401Error on HTTP 401
     * @throws \Pago\V2026_04\Errors\VerifyEmailUpdate422Error on HTTP 422
     */
    public function verifyEmailUpdate(
        CustomerEmailUpdateVerifyRequest $body,
    ): CustomerEmailUpdateVerifyResponse {
        $response = $this->transport->request(
            'POST',
            '/v1/customer-portal/customers/me/email-update/verify',
            [
            ],
            [
            ],
            Json::encode($body),
            'json',
            [
                401 => \Pago\V2026_04\Errors\VerifyEmailUpdate401Error::class,
                422 => \Pago\V2026_04\Errors\VerifyEmailUpdate422Error::class,
            ],
        );

        $result = CustomerEmailUpdateVerifyResponse::fromArray(Json::toMap($response));

        return $result;
    }
}