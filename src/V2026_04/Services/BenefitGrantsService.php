<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\BenefitGrant;
use Pago\V2026_04\Models\BenefitGrantSortProperty;
use Pago\V2026_04\Models\ListResourceBenefitGrant;

/**
 * BenefitGrants operations.
 */
final class BenefitGrantsService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * List benefit grants across all benefits accessible to the authenticated subject.
     *
     * **Scopes**: `benefits:read` `benefits:write`
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $customerId Filter by customer ID.
     * @param string|list<string>|null $externalCustomerId Filter by customer external ID.
     * @param bool|null $isGranted Filter by granted status. If `true`, only granted benefits will be returned. If `false`, only revoked benefits will be returned.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<BenefitGrantSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function list(
        string|array|null $organizationId = null,
        string|array|null $customerId = null,
        string|array|null $externalCustomerId = null,
        ?bool $isGranted = null,
        ?int $page = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): ListResourceBenefitGrant {
        $response = $this->transport->request(
            'GET',
            '/v1/benefit-grants/',
            [
            ],
            [
                'organization_id' => Json::encode($organizationId),
                'customer_id' => Json::encode($customerId),
                'external_customer_id' => Json::encode($externalCustomerId),
                'is_granted' => Json::encode($isGranted),
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

        $result = ListResourceBenefitGrant::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List benefit grants across all benefits accessible to the authenticated subject.
     *
     * Lazily iterates every page returned by {@see self::list()}.
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $customerId Filter by customer ID.
     * @param string|list<string>|null $externalCustomerId Filter by customer external ID.
     * @param bool|null $isGranted Filter by granted status. If `true`, only granted benefits will be returned. If `false`, only revoked benefits will be returned.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<BenefitGrantSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @return Page<BenefitGrant>
     */
    public function listPaginated(
        string|array|null $organizationId = null,
        string|array|null $customerId = null,
        string|array|null $externalCustomerId = null,
        ?bool $isGranted = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): Page {
        /** @var \Closure(int): array{0: list<BenefitGrant>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($organizationId, $customerId, $externalCustomerId, $isGranted, $limit, $sorting): array {
            $result = $this->list(
                organizationId: $organizationId,
                customerId: $customerId,
                externalCustomerId: $externalCustomerId,
                isGranted: $isGranted,
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