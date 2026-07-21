<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\V2026_04\Models\CustomerSeat;
use Pago\V2026_04\Models\CustomerSeatClaimResponse;
use Pago\V2026_04\Models\SeatAssign;
use Pago\V2026_04\Models\SeatClaim;
use Pago\V2026_04\Models\SeatClaimInfo;
use Pago\V2026_04\Models\SeatsList;

/**
 * CustomerSeats operations.
 */
final class CustomerSeatsService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * **Scopes**: `customer_seats:read`
     *
     * @param string|null $subscriptionId subscription_id
     * @param string|null $orderId order_id
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
            '/v1/customer-seats',
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
     * **Scopes**: `customer_seats:write`
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
        SeatAssign $body,
    ): CustomerSeat {
        $response = $this->transport->request(
            'POST',
            '/v1/customer-seats',
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
     * **Scopes**: `customer_seats:write`
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
            '/v1/customer-seats/{seat_id}',
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
     * **Scopes**: `customer_seats:write`
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
            '/v1/customer-seats/{seat_id}/resend',
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
     * get_claim_info
     *
     * @param $invitationToken invitation_token
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\GetClaimInfo400Error on HTTP 400
     * @throws \Pago\V2026_04\Errors\GetClaimInfo403Error on HTTP 403
     * @throws \Pago\V2026_04\Errors\GetClaimInfo404Error on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function getClaimInfo(
        string $invitationToken,
    ): SeatClaimInfo {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-seats/claim/{invitation_token}',
            [
                'invitation_token' => Json::encode($invitationToken),
            ],
            [
            ],
            null,
            'json',
            [
                400 => \Pago\V2026_04\Errors\GetClaimInfo400Error::class,
                403 => \Pago\V2026_04\Errors\GetClaimInfo403Error::class,
                404 => \Pago\V2026_04\Errors\GetClaimInfo404Error::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = SeatClaimInfo::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * claim_seat
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ClaimSeat400Error on HTTP 400
     * @throws \Pago\V2026_04\Errors\ClaimSeat403Error on HTTP 403
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function claimSeat(
        SeatClaim $body,
    ): CustomerSeatClaimResponse {
        $response = $this->transport->request(
            'POST',
            '/v1/customer-seats/claim',
            [
            ],
            [
            ],
            Json::encode($body),
            'json',
            [
                400 => \Pago\V2026_04\Errors\ClaimSeat400Error::class,
                403 => \Pago\V2026_04\Errors\ClaimSeat403Error::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = CustomerSeatClaimResponse::fromArray(Json::toMap($response));

        return $result;
    }
}