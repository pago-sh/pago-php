<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services\Customers;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\V2026_04\Models\Member;
use Pago\V2026_04\Models\MemberCreateFromCustomer;
use Pago\V2026_04\Models\MemberUpdate;

/**
 * Members operations.
 */
final class MembersService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * Create a new member for a customer.
     *
     * Only B2B customers with the member management feature enabled can add members.
     * The authenticated user or organization must have access to the customer's organization.
     *
     * **Scopes**: `members:write`
     *
     * @param $id The customer ID.
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\NotPermitted on HTTP 403
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function create(
        string $id,
        MemberCreateFromCustomer $body,
    ): Member {
        $response = $this->transport->request(
            'POST',
            '/v1/customers/{id}/members',
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

        $result = Member::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Create a new member for a customer identified by its external ID.
     *
     * **Scopes**: `members:write`
     *
     * @param $externalIdPath The customer external ID.
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\NotPermitted on HTTP 403
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\AmbiguousExternalCustomerID on HTTP 409
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function createExternal(
        string $externalIdPath,
        MemberCreateFromCustomer $body,
    ): Member {
        $response = $this->transport->request(
            'POST',
            '/v1/customers/external/{external_id}/members',
            [
                'external_id' => Json::encode($externalIdPath),
            ],
            [
            ],
            Json::encode($body),
            'json',
            [
                403 => \Pago\V2026_04\Errors\NotPermitted::class,
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                409 => \Pago\V2026_04\Errors\AmbiguousExternalCustomerID::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = Member::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get a member of a customer by its ID.
     *
     * **Scopes**: `members:read` `members:write`
     *
     * @param $id The customer ID.
     * @param $memberId member_id
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function get(
        string $id,
        string $memberId,
    ): Member {
        $response = $this->transport->request(
            'GET',
            '/v1/customers/{id}/members/{member_id}',
            [
                'id' => Json::encode($id),
                'member_id' => Json::encode($memberId),
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

        $result = Member::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Delete a member of a customer.
     *
     * **Scopes**: `members:write`
     *
     * @param $id The customer ID.
     * @param $memberId member_id
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function delete(
        string $id,
        string $memberId,
    ): void {
        $this->transport->request(
            'DELETE',
            '/v1/customers/{id}/members/{member_id}',
            [
                'id' => Json::encode($id),
                'member_id' => Json::encode($memberId),
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
     * Update a member of a customer.
     *
     * Only name, email and role can be updated.
     *
     * **Scopes**: `members:write`
     *
     * @param $id The customer ID.
     * @param $memberId member_id
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
        string $memberId,
        MemberUpdate $body,
    ): Member {
        $response = $this->transport->request(
            'PATCH',
            '/v1/customers/{id}/members/{member_id}',
            [
                'id' => Json::encode($id),
                'member_id' => Json::encode($memberId),
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

        $result = Member::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get a member by external ID for a customer identified by its external ID.
     *
     * **Scopes**: `members:read` `members:write`
     *
     * @param $externalId The customer external ID.
     * @param $memberExternalId The member external ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\AmbiguousExternalCustomerID on HTTP 409
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function getExternal(
        string $externalId,
        string $memberExternalId,
    ): Member {
        $response = $this->transport->request(
            'GET',
            '/v1/customers/external/{external_id}/members/{member_external_id}',
            [
                'external_id' => Json::encode($externalId),
                'member_external_id' => Json::encode($memberExternalId),
            ],
            [
            ],
            null,
            'json',
            [
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                409 => \Pago\V2026_04\Errors\AmbiguousExternalCustomerID::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = Member::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Delete a member by external ID for a customer identified by its external ID.
     *
     * **Scopes**: `members:write`
     *
     * @param $externalId The customer external ID.
     * @param $memberExternalId The member external ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\AmbiguousExternalCustomerID on HTTP 409
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function deleteExternal(
        string $externalId,
        string $memberExternalId,
    ): void {
        $this->transport->request(
            'DELETE',
            '/v1/customers/external/{external_id}/members/{member_external_id}',
            [
                'external_id' => Json::encode($externalId),
                'member_external_id' => Json::encode($memberExternalId),
            ],
            [
            ],
            null,
            'none',
            [
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                409 => \Pago\V2026_04\Errors\AmbiguousExternalCustomerID::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );
    }

    /**
     * Update a member by external ID for a customer identified by its external ID.
     *
     * **Scopes**: `members:write`
     *
     * @param $externalId The customer external ID.
     * @param $memberExternalId The member external ID.
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\AmbiguousExternalCustomerID on HTTP 409
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function updateExternal(
        string $externalId,
        string $memberExternalId,
        MemberUpdate $body,
    ): Member {
        $response = $this->transport->request(
            'PATCH',
            '/v1/customers/external/{external_id}/members/{member_external_id}',
            [
                'external_id' => Json::encode($externalId),
                'member_external_id' => Json::encode($memberExternalId),
            ],
            [
            ],
            Json::encode($body),
            'json',
            [
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                409 => \Pago\V2026_04\Errors\AmbiguousExternalCustomerID::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = Member::fromArray(Json::toMap($response));

        return $result;
    }
}