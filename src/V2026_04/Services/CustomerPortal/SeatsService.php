<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services\CustomerPortal;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\CustomerSeat;
use Pago\V2026_04\Models\CustomerSeatAssign;
use Pago\V2026_04\Models\CustomerSubscription;
use Pago\V2026_04\Models\ListResourceCustomerSubscription;
use Pago\V2026_04\Models\SeatsList;

/**
 * Seats operations.
 */
final class SeatsService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * **Scopes**: `customer_portal:read` `customer_portal:write`
     *
     * @param string|null $subscriptionId Subscription ID
     * @param string|null $orderId Order ID
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ListSeats401Error on HTTP 401
     * @throws \Pago\V2026_04\Errors\ListSeats403Error on HTTP 403
     * @throws \Pago\V2026_04\Errors\ListSeats404Error on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function listSeats(
        ?string $subscriptionId = null,
        ?string $orderId = null,
    ): SeatsList {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-portal/seats',
            [
            ],
            [
                'subscription_id' => Json::encode($subscriptionId),
                'order_id' => Json::encode($orderId),
            ],
            null,
            'json',
            [
                401 => \Pago\V2026_04\Errors\ListSeats401Error::class,
                403 => \Pago\V2026_04\Errors\ListSeats403Error::class,
                404 => \Pago\V2026_04\Errors\ListSeats404Error::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = SeatsList::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * assign_seat
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\AssignSeat400Error on HTTP 400
     * @throws \Pago\V2026_04\Errors\AssignSeat401Error on HTTP 401
     * @throws \Pago\V2026_04\Errors\AssignSeat403Error on HTTP 403
     * @throws \Pago\V2026_04\Errors\AssignSeat404Error on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function assignSeat(
        CustomerSeatAssign $body,
    ): CustomerSeat {
        $response = $this->transport->request(
            'POST',
            '/v1/customer-portal/seats',
            [
            ],
            [
            ],
            Json::encode($body),
            'json',
            [
                400 => \Pago\V2026_04\Errors\AssignSeat400Error::class,
                401 => \Pago\V2026_04\Errors\AssignSeat401Error::class,
                403 => \Pago\V2026_04\Errors\AssignSeat403Error::class,
                404 => \Pago\V2026_04\Errors\AssignSeat404Error::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = CustomerSeat::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * revoke_seat
     *
     * @param $seatId seat_id
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\RevokeSeat401Error on HTTP 401
     * @throws \Pago\V2026_04\Errors\RevokeSeat403Error on HTTP 403
     * @throws \Pago\V2026_04\Errors\RevokeSeat404Error on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function revokeSeat(
        string $seatId,
    ): CustomerSeat {
        $response = $this->transport->request(
            'DELETE',
            '/v1/customer-portal/seats/{seat_id}',
            [
                'seat_id' => Json::encode($seatId),
            ],
            [
            ],
            null,
            'json',
            [
                401 => \Pago\V2026_04\Errors\RevokeSeat401Error::class,
                403 => \Pago\V2026_04\Errors\RevokeSeat403Error::class,
                404 => \Pago\V2026_04\Errors\RevokeSeat404Error::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = CustomerSeat::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * resend_invitation
     *
     * @param $seatId seat_id
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResendInvitation400Error on HTTP 400
     * @throws \Pago\V2026_04\Errors\ResendInvitation401Error on HTTP 401
     * @throws \Pago\V2026_04\Errors\ResendInvitation403Error on HTTP 403
     * @throws \Pago\V2026_04\Errors\ResendInvitation404Error on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function resendInvitation(
        string $seatId,
    ): CustomerSeat {
        $response = $this->transport->request(
            'POST',
            '/v1/customer-portal/seats/{seat_id}/resend',
            [
                'seat_id' => Json::encode($seatId),
            ],
            [
            ],
            null,
            'json',
            [
                400 => \Pago\V2026_04\Errors\ResendInvitation400Error::class,
                401 => \Pago\V2026_04\Errors\ResendInvitation401Error::class,
                403 => \Pago\V2026_04\Errors\ResendInvitation403Error::class,
                404 => \Pago\V2026_04\Errors\ResendInvitation404Error::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = CustomerSeat::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List all subscriptions where the authenticated customer has claimed a seat.
     *
     * **Scopes**: `customer_portal:read` `customer_portal:write`
     *
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ListClaimedSubscriptions401Error on HTTP 401
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function listClaimedSubscriptions(
        ?int $page = null,
        ?int $limit = null,
    ): ListResourceCustomerSubscription {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-portal/seats/subscriptions',
            [
            ],
            [
                'page' => Json::encode($page),
                'limit' => Json::encode($limit),
            ],
            null,
            'json',
            [
                401 => \Pago\V2026_04\Errors\ListClaimedSubscriptions401Error::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = ListResourceCustomerSubscription::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List all subscriptions where the authenticated customer has claimed a seat.
     *
     * Lazily iterates every page returned by {@see self::listClaimedSubscriptions()}.
     *
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @return Page<CustomerSubscription>
     */
    public function listClaimedSubscriptionsPaginated(
        ?int $limit = null,
    ): Page {
        /** @var \Closure(int): array{0: list<CustomerSubscription>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($limit): array {
            $result = $this->listClaimedSubscriptions(
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