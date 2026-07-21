<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services\CustomerPortal;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\DownloadableRead;
use Pago\V2026_04\Models\ListResourceDownloadableRead;

/**
 * Downloadables operations.
 */
final class DownloadablesService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * **Scopes**: `customer_portal:read` `customer_portal:write`
     *
     * @param string|list<string>|null $benefitId Filter by benefit ID.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function list(
        string|array|null $benefitId = null,
        ?int $page = null,
        ?int $limit = null,
    ): ListResourceDownloadableRead {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-portal/downloadables/',
            [
            ],
            [
                'benefit_id' => Json::encode($benefitId),
                'page' => Json::encode($page),
                'limit' => Json::encode($limit),
            ],
            null,
            'json',
            [
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = ListResourceDownloadableRead::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * **Scopes**: `customer_portal:read` `customer_portal:write`
     *
     * Lazily iterates every page returned by {@see self::list()}.
     *
     * @param string|list<string>|null $benefitId Filter by benefit ID.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @return Page<DownloadableRead>
     */
    public function listPaginated(
        string|array|null $benefitId = null,
        ?int $limit = null,
    ): Page {
        /** @var \Closure(int): array{0: list<DownloadableRead>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($benefitId, $limit): array {
            $result = $this->list(
                benefitId: $benefitId,
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