<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Services\Customers\MembersService;
use Pago\V2026_04\Models\Customer;
use Pago\V2026_04\Models\CustomerCreate;
use Pago\V2026_04\Models\CustomerCreateFactory;
use Pago\V2026_04\Models\CustomerFactory;
use Pago\V2026_04\Models\CustomerSortProperty;
use Pago\V2026_04\Models\CustomerState;
use Pago\V2026_04\Models\CustomerStateFactory;
use Pago\V2026_04\Models\CustomerUpdate;
use Pago\V2026_04\Models\CustomerUpdateExternalID;
use Pago\V2026_04\Models\ListResourceCustomer;
use Pago\V2026_04\Models\ListResourcePaymentMethod;
use Pago\V2026_04\Models\PaymentMethod;
use Pago\V2026_04\Models\PaymentMethodFactory;

/**
 * Customers operations.
 */
final class CustomersService
{
    public readonly MembersService $members;

    public function __construct(private readonly Transport $transport)
    {
        $this->members = new MembersService($transport);
    }

    /**
     * List customers.
     *
     * **Scopes**: `customers:read` `customers:write`
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|null $email Filter by exact email.
     * @param string|null $query Filter by name, email, or external ID.
     * @param bool|null $active Filter by active customers, i.e. customers with at least one trialing, active or past_due subscription.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<CustomerSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @param array<string, string|int|bool|list<string>|list<int>|list<bool>>|null $metadata Filter by metadata key-value pairs. It uses the `deepObject` style, e.g. `?metadata[key]=value`.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function list(
        string|array|null $organizationId = null,
        ?string $email = null,
        ?string $query = null,
        ?bool $active = null,
        ?int $page = null,
        ?int $limit = null,
        ?array $sorting = null,
        ?array $metadata = null,
    ): ListResourceCustomer {
        $response = $this->transport->request(
            'GET',
            '/v1/customers/',
            [
            ],
            [
                'organization_id' => Json::encode($organizationId),
                'email' => Json::encode($email),
                'query' => Json::encode($query),
                'active' => Json::encode($active),
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

        $result = ListResourceCustomer::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List customers.
     *
     * Lazily iterates every page returned by {@see self::list()}.
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|null $email Filter by exact email.
     * @param string|null $query Filter by name, email, or external ID.
     * @param bool|null $active Filter by active customers, i.e. customers with at least one trialing, active or past_due subscription.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<CustomerSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @param array<string, string|int|bool|list<string>|list<int>|list<bool>>|null $metadata Filter by metadata key-value pairs. It uses the `deepObject` style, e.g. `?metadata[key]=value`.
     * @return Page<Customer>
     */
    public function listPaginated(
        string|array|null $organizationId = null,
        ?string $email = null,
        ?string $query = null,
        ?bool $active = null,
        ?int $limit = null,
        ?array $sorting = null,
        ?array $metadata = null,
    ): Page {
        /** @var \Closure(int): array{0: list<Customer>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($organizationId, $email, $query, $active, $limit, $sorting, $metadata): array {
            $result = $this->list(
                organizationId: $organizationId,
                email: $email,
                query: $query,
                active: $active,
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
     * Create a customer.
     *
     * **Scopes**: `customers:write`
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function create(
        CustomerCreate $body,
    ): Customer {
        $response = $this->transport->request(
            'POST',
            '/v1/customers/',
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

        $result = CustomerFactory::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Export customers as a CSV file.
     *
     * **Scopes**: `customers:read` `customers:write`
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function export(
        string|array|null $organizationId = null,
    ): string {
        $response = $this->transport->request(
            'GET',
            '/v1/customers/export',
            [
            ],
            [
                'organization_id' => Json::encode($organizationId),
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
     * Get a customer by ID.
     *
     * **Scopes**: `customers:read` `customers:write`
     *
     * @param $id The customer ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function get(
        string $id,
    ): Customer {
        $response = $this->transport->request(
            'GET',
            '/v1/customers/{id}',
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

        $result = CustomerFactory::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Delete a customer.
     *
     * This action cannot be undone and will immediately:
     * - Cancel any active subscriptions for the customer
     * - Revoke all their benefits
     * - Clear any `external_id`
     *
     * Use it only in the context of deleting a user within your
     * own service. Otherwise, use more granular API endpoints to cancel
     * a specific subscription or revoke certain benefits.
     *
     * Note: The customers information will nonetheless be retained for historic
     * orders and subscriptions.
     *
     * Set `anonymize=true` to also anonymize PII for GDPR compliance.
     *
     * **Scopes**: `customers:write`
     *
     * @param $id The customer ID.
     * @param bool|null $anonymize If true, also anonymize the customer's personal data for GDPR compliance. This replaces email with a hashed version, hashes name and billing name (name preserved for businesses with tax_id), clears billing address, and removes OAuth account data.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function delete(
        string $id,
        ?bool $anonymize = null,
    ): void {
        $this->transport->request(
            'DELETE',
            '/v1/customers/{id}',
            [
                'id' => Json::encode($id),
            ],
            [
                'anonymize' => Json::encode($anonymize),
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
     * Update a customer.
     *
     * **Scopes**: `customers:write`
     *
     * @param $id The customer ID.
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
        CustomerUpdate $body,
    ): Customer {
        $response = $this->transport->request(
            'PATCH',
            '/v1/customers/{id}',
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

        $result = CustomerFactory::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get a customer by external ID.
     *
     * **Scopes**: `customers:read` `customers:write`
     *
     * @param $externalId The customer external ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function getExternal(
        string $externalId,
    ): Customer {
        $response = $this->transport->request(
            'GET',
            '/v1/customers/external/{external_id}',
            [
                'external_id' => Json::encode($externalId),
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

        $result = CustomerFactory::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Delete a customer by external ID.
     *
     * Immediately cancels any active subscriptions and revokes any active benefits.
     *
     * Set `anonymize=true` to also anonymize PII for GDPR compliance.
     *
     * **Scopes**: `customers:write`
     *
     * @param $externalId The customer external ID.
     * @param bool|null $anonymize If true, also anonymize the customer's personal data for GDPR compliance.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function deleteExternal(
        string $externalId,
        ?bool $anonymize = null,
    ): void {
        $this->transport->request(
            'DELETE',
            '/v1/customers/external/{external_id}',
            [
                'external_id' => Json::encode($externalId),
            ],
            [
                'anonymize' => Json::encode($anonymize),
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
     * Update a customer by external ID.
     *
     * **Scopes**: `customers:write`
     *
     * @param $externalId The customer external ID.
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function updateExternal(
        string $externalId,
        CustomerUpdateExternalID $body,
    ): Customer {
        $response = $this->transport->request(
            'PATCH',
            '/v1/customers/external/{external_id}',
            [
                'external_id' => Json::encode($externalId),
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

        $result = CustomerFactory::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get a customer state by ID.
     *
     * The customer state includes information about
     * the customer's active subscriptions and benefits.
     *
     * It's the ideal endpoint to use when you need to get a full overview
     * of a customer's status.
     *
     * **Scopes**: `customers:read` `customers:write`
     *
     * @param $id The customer ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function getState(
        string $id,
    ): CustomerState {
        $response = $this->transport->request(
            'GET',
            '/v1/customers/{id}/state',
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

        $result = CustomerStateFactory::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get a customer state by external ID.
     *
     * The customer state includes information about
     * the customer's active subscriptions and benefits.
     *
     * It's the ideal endpoint to use when you need to get a full overview
     * of a customer's status.
     *
     * **Scopes**: `customers:read` `customers:write`
     *
     * @param $externalId The customer external ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function getStateExternal(
        string $externalId,
    ): CustomerState {
        $response = $this->transport->request(
            'GET',
            '/v1/customers/external/{external_id}/state',
            [
                'external_id' => Json::encode($externalId),
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

        $result = CustomerStateFactory::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get saved payment methods of a customer.
     *
     * **Scopes**: `customers:read` `customers:write`
     *
     * @param $id The customer ID.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function listPaymentMethods(
        string $id,
        ?int $page = null,
        ?int $limit = null,
    ): ListResourcePaymentMethod {
        $response = $this->transport->request(
            'GET',
            '/v1/customers/{id}/payment-methods',
            [
                'id' => Json::encode($id),
            ],
            [
                'page' => Json::encode($page),
                'limit' => Json::encode($limit),
            ],
            null,
            'json',
            [
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = ListResourcePaymentMethod::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get saved payment methods of a customer.
     *
     * Lazily iterates every page returned by {@see self::listPaymentMethods()}.
     *
     * @param $id The customer ID.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @return Page<PaymentMethod>
     */
    public function listPaymentMethodsPaginated(
        string $id,
        ?int $limit = null,
    ): Page {
        /** @var \Closure(int): array{0: list<PaymentMethod>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($id, $limit): array {
            $result = $this->listPaymentMethods(
                id: $id,
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
     * Get saved payment methods of a customer by external ID.
     *
     * **Scopes**: `customers:read` `customers:write`
     *
     * @param $externalId The customer external ID.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function listPaymentMethodsExternal(
        string $externalId,
        ?int $page = null,
        ?int $limit = null,
    ): ListResourcePaymentMethod {
        $response = $this->transport->request(
            'GET',
            '/v1/customers/external/{external_id}/payment-methods',
            [
                'external_id' => Json::encode($externalId),
            ],
            [
                'page' => Json::encode($page),
                'limit' => Json::encode($limit),
            ],
            null,
            'json',
            [
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = ListResourcePaymentMethod::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get saved payment methods of a customer by external ID.
     *
     * Lazily iterates every page returned by {@see self::listPaymentMethodsExternal()}.
     *
     * @param $externalId The customer external ID.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @return Page<PaymentMethod>
     */
    public function listPaymentMethodsExternalPaginated(
        string $externalId,
        ?int $limit = null,
    ): Page {
        /** @var \Closure(int): array{0: list<PaymentMethod>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($externalId, $limit): array {
            $result = $this->listPaymentMethodsExternal(
                externalId: $externalId,
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
}