<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services\Oauth2\Clients;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\V2026_04\Models\OAuth2ClientConfiguration;
use Pago\V2026_04\Models\OAuth2ClientConfigurationUpdate;

/**
 * Oauth2 operations.
 */
final class Oauth2Service
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * Create an OAuth2 client.
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function createClient(
        OAuth2ClientConfiguration $body,
    ): mixed {
        $response = $this->transport->request(
            'POST',
            '/v1/oauth2/register',
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

        $result = $response;

        return $result;
    }

    /**
     * Get an OAuth2 client by Client ID.
     *
     * @param $clientId client_id
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function getClient(
        string $clientId,
    ): mixed {
        $response = $this->transport->request(
            'GET',
            '/v1/oauth2/register/{client_id}',
            [
                'client_id' => Json::encode($clientId),
            ],
            [
            ],
            null,
            'json',
            [
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = $response;

        return $result;
    }

    /**
     * Update an OAuth2 client.
     *
     * @param $clientIdPath client_id
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function updateClient(
        string $clientIdPath,
        OAuth2ClientConfigurationUpdate $body,
    ): mixed {
        $response = $this->transport->request(
            'PUT',
            '/v1/oauth2/register/{client_id}',
            [
                'client_id' => Json::encode($clientIdPath),
            ],
            [
            ],
            Json::encode($body),
            'json',
            [
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = $response;

        return $result;
    }

    /**
     * Delete an OAuth2 client.
     *
     * @param $clientId client_id
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function deleteClient(
        string $clientId,
    ): void {
        $this->transport->request(
            'DELETE',
            '/v1/oauth2/register/{client_id}',
            [
                'client_id' => Json::encode($clientId),
            ],
            [
            ],
            null,
            'none',
            [
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );
    }
}