<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\V2026_04\Models\CustomerSession;
use Pago\V2026_04\Models\CustomerSessionCustomerExternalIDCreate;
use Pago\V2026_04\Models\CustomerSessionCustomerIDCreate;

/**
 * CustomerSessions operations.
 */
final class CustomerSessionsService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * Create a customer session.
     *
     * For organizations with `member_model_enabled`, this will automatically
     * create a member session for the owner member of the customer.
     *
     * **Scopes**: `customer_sessions:write`
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function create(
        CustomerSessionCustomerIDCreate|CustomerSessionCustomerExternalIDCreate $body,
    ): CustomerSession {
        $response = $this->transport->request(
            'POST',
            '/v1/customer-sessions/',
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

        $result = CustomerSession::fromArray(Json::toMap($response));

        return $result;
    }
}