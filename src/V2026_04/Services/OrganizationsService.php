<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\ListResourceOrganization;
use Pago\V2026_04\Models\Organization;
use Pago\V2026_04\Models\OrganizationCreate;
use Pago\V2026_04\Models\OrganizationSortProperty;
use Pago\V2026_04\Models\OrganizationUpdate;

/**
 * Organizations operations.
 */
final class OrganizationsService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * List organizations.
     *
     * **Scopes**: `organizations:read` `organizations:write`
     *
     * @param string|null $slug Filter by slug.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<OrganizationSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function list(
        ?string $slug = null,
        ?int $page = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): ListResourceOrganization {
        $response = $this->transport->request(
            'GET',
            '/v1/organizations/',
            [
            ],
            [
                'slug' => Json::encode($slug),
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

        $result = ListResourceOrganization::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List organizations.
     *
     * Lazily iterates every page returned by {@see self::list()}.
     *
     * @param string|null $slug Filter by slug.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<OrganizationSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @return Page<Organization>
     */
    public function listPaginated(
        ?string $slug = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): Page {
        /** @var \Closure(int): array{0: list<Organization>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($slug, $limit, $sorting): array {
            $result = $this->list(
                slug: $slug,
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
     * Create an organization.
     *
     * **Scopes**: `organizations:write`
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\CannotCreateOrganizationError on HTTP 403
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function create(
        OrganizationCreate $body,
    ): Organization {
        $response = $this->transport->request(
            'POST',
            '/v1/organizations/',
            [
            ],
            [
            ],
            Json::encode($body),
            'json',
            [
                403 => \Pago\V2026_04\Errors\CannotCreateOrganizationError::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = Organization::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get an organization by ID.
     *
     * **Scopes**: `organizations:read` `organizations:write`
     *
     * @param $id id
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function get(
        string $id,
    ): Organization {
        $response = $this->transport->request(
            'GET',
            '/v1/organizations/{id}',
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

        $result = Organization::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Update an organization.
     *
     * **Scopes**: `organizations:write`
     *
     * @param $id id
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\NotPermitted on HTTP 403
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\SSOEnforcementRequiresConnection on HTTP 409
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function update(
        string $id,
        OrganizationUpdate $body,
    ): Organization {
        $response = $this->transport->request(
            'PATCH',
            '/v1/organizations/{id}',
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
                409 => \Pago\V2026_04\Errors\SSOEnforcementRequiresConnection::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = Organization::fromArray(Json::toMap($response));

        return $result;
    }
}