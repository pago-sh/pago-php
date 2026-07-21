<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services\CustomerPortal;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\CustomerWallet;
use Pago\V2026_04\Models\CustomerWalletSortProperty;
use Pago\V2026_04\Models\ListResourceCustomerWallet;

/**
 * Wallets operations.
 */
final class WalletsService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * List wallets of the authenticated customer.
     *
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<CustomerWalletSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function list(
        ?int $page = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): ListResourceCustomerWallet {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-portal/wallets/',
            [
            ],
            [
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

        $result = ListResourceCustomerWallet::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List wallets of the authenticated customer.
     *
     * Lazily iterates every page returned by {@see self::list()}.
     *
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<CustomerWalletSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @return Page<CustomerWallet>
     */
    public function listPaginated(
        ?int $limit = null,
        ?array $sorting = null,
    ): Page {
        /** @var \Closure(int): array{0: list<CustomerWallet>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($limit, $sorting): array {
            $result = $this->list(
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
     * Get a wallet by ID for the authenticated customer.
     *
     * @param $id The wallet ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function get(
        string $id,
    ): CustomerWallet {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-portal/wallets/{id}',
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

        $result = CustomerWallet::fromArray(Json::toMap($response));

        return $result;
    }
}