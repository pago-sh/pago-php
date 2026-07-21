<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\Benefit;
use Pago\V2026_04\Models\BenefitCreate;
use Pago\V2026_04\Models\BenefitCreateFactory;
use Pago\V2026_04\Models\BenefitCustomUpdate;
use Pago\V2026_04\Models\BenefitDiscordUpdate;
use Pago\V2026_04\Models\BenefitDownloadablesUpdate;
use Pago\V2026_04\Models\BenefitFactory;
use Pago\V2026_04\Models\BenefitFeatureFlagUpdate;
use Pago\V2026_04\Models\BenefitGitHubRepositoryUpdate;
use Pago\V2026_04\Models\BenefitGrant;
use Pago\V2026_04\Models\BenefitLicenseKeysUpdate;
use Pago\V2026_04\Models\BenefitMeterCreditUpdate;
use Pago\V2026_04\Models\BenefitSlackSharedChannelUpdate;
use Pago\V2026_04\Models\BenefitSortProperty;
use Pago\V2026_04\Models\BenefitType;
use Pago\V2026_04\Models\ListResourceBenefit;
use Pago\V2026_04\Models\ListResourceBenefitGrant;

/**
 * Benefits operations.
 */
final class BenefitsService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * List benefits.
     *
     * **Scopes**: `benefits:read` `benefits:write`
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param BenefitType|list<BenefitType>|null $type Filter by benefit type.
     * @param string|list<string>|null $id Filter by benefit IDs.
     * @param string|list<string>|null $excludeId Exclude benefits with these IDs.
     * @param string|null $query Filter by description.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<BenefitSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @param array<string, string|int|bool|list<string>|list<int>|list<bool>>|null $metadata Filter by metadata key-value pairs. It uses the `deepObject` style, e.g. `?metadata[key]=value`.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function list(
        string|array|null $organizationId = null,
        BenefitType|array|null $type = null,
        string|array|null $id = null,
        string|array|null $excludeId = null,
        ?string $query = null,
        ?int $page = null,
        ?int $limit = null,
        ?array $sorting = null,
        ?array $metadata = null,
    ): ListResourceBenefit {
        $response = $this->transport->request(
            'GET',
            '/v1/benefits/',
            [
            ],
            [
                'organization_id' => Json::encode($organizationId),
                'type' => Json::encode($type),
                'id' => Json::encode($id),
                'exclude_id' => Json::encode($excludeId),
                'query' => Json::encode($query),
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

        $result = ListResourceBenefit::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List benefits.
     *
     * Lazily iterates every page returned by {@see self::list()}.
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param BenefitType|list<BenefitType>|null $type Filter by benefit type.
     * @param string|list<string>|null $id Filter by benefit IDs.
     * @param string|list<string>|null $excludeId Exclude benefits with these IDs.
     * @param string|null $query Filter by description.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<BenefitSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @param array<string, string|int|bool|list<string>|list<int>|list<bool>>|null $metadata Filter by metadata key-value pairs. It uses the `deepObject` style, e.g. `?metadata[key]=value`.
     * @return Page<Benefit>
     */
    public function listPaginated(
        string|array|null $organizationId = null,
        BenefitType|array|null $type = null,
        string|array|null $id = null,
        string|array|null $excludeId = null,
        ?string $query = null,
        ?int $limit = null,
        ?array $sorting = null,
        ?array $metadata = null,
    ): Page {
        /** @var \Closure(int): array{0: list<Benefit>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($organizationId, $type, $id, $excludeId, $query, $limit, $sorting, $metadata): array {
            $result = $this->list(
                organizationId: $organizationId,
                type: $type,
                id: $id,
                excludeId: $excludeId,
                query: $query,
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
     * Create a benefit.
     *
     * **Scopes**: `benefits:write`
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function create(
        BenefitCreate $body,
    ): Benefit {
        $response = $this->transport->request(
            'POST',
            '/v1/benefits/',
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

        $result = BenefitFactory::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get a benefit by ID.
     *
     * **Scopes**: `benefits:read` `benefits:write`
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
    ): Benefit {
        $response = $this->transport->request(
            'GET',
            '/v1/benefits/{id}',
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

        $result = BenefitFactory::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Delete a benefit.
     *
     * > [!WARNING]
     * > Every grants associated with the benefit will be revoked.
     * > Users will lose access to the benefit.
     *
     * **Scopes**: `benefits:write`
     *
     * @param $id id
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\NotPermitted on HTTP 403
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function delete(
        string $id,
    ): void {
        $this->transport->request(
            'DELETE',
            '/v1/benefits/{id}',
            [
                'id' => Json::encode($id),
            ],
            [
            ],
            null,
            'none',
            [
                403 => \Pago\V2026_04\Errors\NotPermitted::class,
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );
    }

    /**
     * Update a benefit.
     *
     * **Scopes**: `benefits:write`
     *
     * @param $id id
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
        BenefitCustomUpdate|BenefitDiscordUpdate|BenefitGitHubRepositoryUpdate|BenefitDownloadablesUpdate|BenefitLicenseKeysUpdate|BenefitMeterCreditUpdate|BenefitFeatureFlagUpdate|BenefitSlackSharedChannelUpdate $body,
    ): Benefit {
        $response = $this->transport->request(
            'PATCH',
            '/v1/benefits/{id}',
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

        $result = BenefitFactory::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List the individual grants for a benefit.
     *
     * It's especially useful to check if a user has been granted a benefit.
     *
     * **Scopes**: `benefits:read` `benefits:write`
     *
     * @param $id id
     * @param bool|null $isGranted Filter by granted status. If `true`, only granted benefits will be returned. If `false`, only revoked benefits will be returned.
     * @param string|list<string>|null $customerId Filter by customer.
     * @param string|list<string>|null $memberId Filter by member.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function grants(
        string $id,
        ?bool $isGranted = null,
        string|array|null $customerId = null,
        string|array|null $memberId = null,
        ?int $page = null,
        ?int $limit = null,
    ): ListResourceBenefitGrant {
        $response = $this->transport->request(
            'GET',
            '/v1/benefits/{id}/grants',
            [
                'id' => Json::encode($id),
            ],
            [
                'is_granted' => Json::encode($isGranted),
                'customer_id' => Json::encode($customerId),
                'member_id' => Json::encode($memberId),
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

        $result = ListResourceBenefitGrant::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List the individual grants for a benefit.
     *
     * Lazily iterates every page returned by {@see self::grants()}.
     *
     * @param $id id
     * @param bool|null $isGranted Filter by granted status. If `true`, only granted benefits will be returned. If `false`, only revoked benefits will be returned.
     * @param string|list<string>|null $customerId Filter by customer.
     * @param string|list<string>|null $memberId Filter by member.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @return Page<BenefitGrant>
     */
    public function grantsPaginated(
        string $id,
        ?bool $isGranted = null,
        string|array|null $customerId = null,
        string|array|null $memberId = null,
        ?int $limit = null,
    ): Page {
        /** @var \Closure(int): array{0: list<BenefitGrant>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($id, $isGranted, $customerId, $memberId, $limit): array {
            $result = $this->grants(
                id: $id,
                isGranted: $isGranted,
                customerId: $customerId,
                memberId: $memberId,
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