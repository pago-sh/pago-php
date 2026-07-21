<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services\CustomerPortal;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\CustomerPortalMember;
use Pago\V2026_04\Models\CustomerPortalMemberCreate;
use Pago\V2026_04\Models\CustomerPortalMemberUpdate;
use Pago\V2026_04\Models\ListResourceCustomerPortalMember;

/**
 * Members operations.
 */
final class MembersService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * List all members of the customer's team.
     *
     * Only available to owners and billing managers of team customers.
     *
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ListMembers401Error on HTTP 401
     * @throws \Pago\V2026_04\Errors\ListMembers403Error on HTTP 403
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function listMembers(
        ?int $page = null,
        ?int $limit = null,
    ): ListResourceCustomerPortalMember {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-portal/members',
            [
            ],
            [
                'page' => Json::encode($page),
                'limit' => Json::encode($limit),
            ],
            null,
            'json',
            [
                401 => \Pago\V2026_04\Errors\ListMembers401Error::class,
                403 => \Pago\V2026_04\Errors\ListMembers403Error::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = ListResourceCustomerPortalMember::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List all members of the customer's team.
     *
     * Lazily iterates every page returned by {@see self::listMembers()}.
     *
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @return Page<CustomerPortalMember>
     */
    public function listMembersPaginated(
        ?int $limit = null,
    ): Page {
        /** @var \Closure(int): array{0: list<CustomerPortalMember>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($limit): array {
            $result = $this->listMembers(
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
     * Add a new member to the customer's team.
     *
     * Only available to owners and billing managers of team customers.
     *
     * Rules:
     * - Cannot add a member with the owner role (there must be exactly one owner)
     * - If a member with this email already exists, the existing member is returned
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\AddMember400Error on HTTP 400
     * @throws \Pago\V2026_04\Errors\AddMember401Error on HTTP 401
     * @throws \Pago\V2026_04\Errors\AddMember403Error on HTTP 403
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function addMember(
        CustomerPortalMemberCreate $body,
    ): CustomerPortalMember {
        $response = $this->transport->request(
            'POST',
            '/v1/customer-portal/members',
            [
            ],
            [
            ],
            Json::encode($body),
            'json',
            [
                400 => \Pago\V2026_04\Errors\AddMember400Error::class,
                401 => \Pago\V2026_04\Errors\AddMember401Error::class,
                403 => \Pago\V2026_04\Errors\AddMember403Error::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = CustomerPortalMember::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Remove a member from the team.
     *
     * Only available to owners and billing managers of team customers.
     *
     * Rules:
     * - Cannot remove yourself
     * - Cannot remove the only owner
     *
     * @param $id id
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\RemoveMember400Error on HTTP 400
     * @throws \Pago\V2026_04\Errors\RemoveMember401Error on HTTP 401
     * @throws \Pago\V2026_04\Errors\RemoveMember403Error on HTTP 403
     * @throws \Pago\V2026_04\Errors\RemoveMember404Error on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function removeMember(
        string $id,
    ): void {
        $this->transport->request(
            'DELETE',
            '/v1/customer-portal/members/{id}',
            [
                'id' => Json::encode($id),
            ],
            [
            ],
            null,
            'none',
            [
                400 => \Pago\V2026_04\Errors\RemoveMember400Error::class,
                401 => \Pago\V2026_04\Errors\RemoveMember401Error::class,
                403 => \Pago\V2026_04\Errors\RemoveMember403Error::class,
                404 => \Pago\V2026_04\Errors\RemoveMember404Error::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );
    }

    /**
     * Update a member's name or role.
     *
     * Only available to owners and billing managers of team customers.
     *
     * Rules:
     * - Cannot modify your own role (to prevent self-demotion)
     * - Customer must have exactly one owner at all times
     *
     * @param $id id
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\UpdateMember400Error on HTTP 400
     * @throws \Pago\V2026_04\Errors\UpdateMember401Error on HTTP 401
     * @throws \Pago\V2026_04\Errors\UpdateMember403Error on HTTP 403
     * @throws \Pago\V2026_04\Errors\UpdateMember404Error on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function updateMember(
        string $id,
        CustomerPortalMemberUpdate $body,
    ): CustomerPortalMember {
        $response = $this->transport->request(
            'PATCH',
            '/v1/customer-portal/members/{id}',
            [
                'id' => Json::encode($id),
            ],
            [
            ],
            Json::encode($body),
            'json',
            [
                400 => \Pago\V2026_04\Errors\UpdateMember400Error::class,
                401 => \Pago\V2026_04\Errors\UpdateMember401Error::class,
                403 => \Pago\V2026_04\Errors\UpdateMember403Error::class,
                404 => \Pago\V2026_04\Errors\UpdateMember404Error::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = CustomerPortalMember::fromArray(Json::toMap($response));

        return $result;
    }
}