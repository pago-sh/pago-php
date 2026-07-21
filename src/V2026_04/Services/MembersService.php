<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\ListResourceMember;
use Pago\V2026_04\Models\Member;
use Pago\V2026_04\Models\MemberRole;
use Pago\V2026_04\Models\MemberSortProperty;

/**
 * Members operations.
 */
final class MembersService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * List members with optional customer ID filter.
     *
     * **Scopes**: `members:read` `members:write`
     *
     * @param string|null $customerId Filter by customer ID.
     * @param string|null $externalCustomerId Filter by customer external ID.
     * @param MemberRole|null $role Filter by member role.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<MemberSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function listMembers(
        ?string $customerId = null,
        ?string $externalCustomerId = null,
        ?MemberRole $role = null,
        ?int $page = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): ListResourceMember {
        $response = $this->transport->request(
            'GET',
            '/v1/members/',
            [
            ],
            [
                'customer_id' => Json::encode($customerId),
                'external_customer_id' => Json::encode($externalCustomerId),
                'role' => Json::encode($role),
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

        $result = ListResourceMember::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List members with optional customer ID filter.
     *
     * Lazily iterates every page returned by {@see self::listMembers()}.
     *
     * @param string|null $customerId Filter by customer ID.
     * @param string|null $externalCustomerId Filter by customer external ID.
     * @param MemberRole|null $role Filter by member role.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<MemberSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @return Page<Member>
     */
    public function listMembersPaginated(
        ?string $customerId = null,
        ?string $externalCustomerId = null,
        ?MemberRole $role = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): Page {
        /** @var \Closure(int): array{0: list<Member>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($customerId, $externalCustomerId, $role, $limit, $sorting): array {
            $result = $this->listMembers(
                customerId: $customerId,
                externalCustomerId: $externalCustomerId,
                role: $role,
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
}