<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services\CustomerPortal;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\V2026_04\Models\CustomerCustomerSession;
use Pago\V2026_04\Models\PortalAuthenticatedUser;

/**
 * CustomerSession operations.
 */
final class CustomerSessionService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * Introspect the current session and return its information.
     *
     * **Scopes**: `customer_portal:read` `customer_portal:write`
     *
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     */
    public function introspect(): CustomerCustomerSession
    {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-portal/customer-session/introspect',
            [
            ],
            [
            ],
            null,
            'json',
            [
            ],
        );

        $result = CustomerCustomerSession::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get information about the currently authenticated portal user.
     *
     * **Scopes**: `customer_portal:read` `customer_portal:write`
     *
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     */
    public function getAuthenticatedUser(): PortalAuthenticatedUser
    {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-portal/customer-session/user',
            [
            ],
            [
            ],
            null,
            'json',
            [
            ],
        );

        $result = PortalAuthenticatedUser::fromArray(Json::toMap($response));

        return $result;
    }
}