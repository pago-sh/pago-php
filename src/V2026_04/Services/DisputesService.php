<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\Dispute;
use Pago\V2026_04\Models\DisputeSortProperty;
use Pago\V2026_04\Models\DisputeStatus;
use Pago\V2026_04\Models\ListResourceDispute;

/**
 * Disputes operations.
 */
final class DisputesService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * List disputes.
     *
     * **Scopes**: `disputes:read` `disputes:write`
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $orderId Filter by order ID.
     * @param DisputeStatus|list<DisputeStatus>|null $status Filter by dispute status.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<DisputeSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function list(
        string|array|null $organizationId = null,
        string|array|null $orderId = null,
        DisputeStatus|array|null $status = null,
        ?int $page = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): ListResourceDispute {
        $response = $this->transport->request(
            'GET',
            '/v1/disputes/',
            [
            ],
            [
                'organization_id' => Json::encode($organizationId),
                'order_id' => Json::encode($orderId),
                'status' => Json::encode($status),
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

        $result = ListResourceDispute::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List disputes.
     *
     * Lazily iterates every page returned by {@see self::list()}.
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $orderId Filter by order ID.
     * @param DisputeStatus|list<DisputeStatus>|null $status Filter by dispute status.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<DisputeSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @return Page<Dispute>
     */
    public function listPaginated(
        string|array|null $organizationId = null,
        string|array|null $orderId = null,
        DisputeStatus|array|null $status = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): Page {
        /** @var \Closure(int): array{0: list<Dispute>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($organizationId, $orderId, $status, $limit, $sorting): array {
            $result = $this->list(
                organizationId: $organizationId,
                orderId: $orderId,
                status: $status,
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
     * Get a dispute by ID.
     *
     * **Scopes**: `disputes:read` `disputes:write`
     *
     * @param $id The dispute ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function get(
        string $id,
    ): Dispute {
        $response = $this->transport->request(
            'GET',
            '/v1/disputes/{id}',
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

        $result = Dispute::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Accept a dispute, conceding the chargeback.
     *
     * Closes the dispute with the processor (settling it as `lost`) and records
     * the merchant's decision on the dispute's support case.
     *
     * **Scopes**: `disputes:write`
     *
     * @param $id The dispute ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\DisputeNotOpenError on HTTP 409
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function accept(
        string $id,
    ): Dispute {
        $response = $this->transport->request(
            'POST',
            '/v1/disputes/{id}/accept',
            [
                'id' => Json::encode($id),
            ],
            [
            ],
            null,
            'json',
            [
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                409 => \Pago\V2026_04\Errors\DisputeNotOpenError::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = Dispute::fromArray(Json::toMap($response));

        return $result;
    }
}