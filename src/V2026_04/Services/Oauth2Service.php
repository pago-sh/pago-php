<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\V2026_04\Services\Oauth2\ClientsService;
use Pago\V2026_04\Models\AuthorizeResponseOrganization;
use Pago\V2026_04\Models\AuthorizeResponseUser;
use Pago\V2026_04\Models\IntrospectTokenResponse;
use Pago\V2026_04\Models\RevokeTokenResponse;
use Pago\V2026_04\Models\TokenResponse;
use Pago\V2026_04\Models\UserInfoOrganization;
use Pago\V2026_04\Models\UserInfoUser;

/**
 * Oauth2 operations.
 */
final class Oauth2Service
{
    public readonly ClientsService $clients;

    public function __construct(private readonly Transport $transport)
    {
        $this->clients = new ClientsService($transport);
    }

    /**
     * authorize
     *
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     */
    public function authorize(): AuthorizeResponseUser|AuthorizeResponseOrganization
    {
        $response = $this->transport->request(
            'GET',
            '/v1/oauth2/authorize',
            [
            ],
            [
            ],
            null,
            'json',
            [
            ],
        );

        /** @var AuthorizeResponseUser|AuthorizeResponseOrganization $result */
        $result = Union::resolve($response, 'sub_type', ['organization' => AuthorizeResponseOrganization::class, 'user' => AuthorizeResponseUser::class], [AuthorizeResponseUser::class, AuthorizeResponseOrganization::class]);

        return $result;
    }

    /**
     * Request an access token using a valid grant.
     *
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     */
    public function requestToken(): TokenResponse
    {
        $response = $this->transport->request(
            'POST',
            '/v1/oauth2/token',
            [
            ],
            [
            ],
            null,
            'json',
            [
            ],
        );

        $result = TokenResponse::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Revoke an access token or a refresh token.
     *
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     */
    public function revokeToken(): RevokeTokenResponse
    {
        $response = $this->transport->request(
            'POST',
            '/v1/oauth2/revoke',
            [
            ],
            [
            ],
            null,
            'json',
            [
            ],
        );

        $result = RevokeTokenResponse::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get information about an access token.
     *
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     */
    public function introspectToken(): IntrospectTokenResponse
    {
        $response = $this->transport->request(
            'POST',
            '/v1/oauth2/introspect',
            [
            ],
            [
            ],
            null,
            'json',
            [
            ],
        );

        $result = IntrospectTokenResponse::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get information about the authenticated user.
     *
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     */
    public function userinfo(): UserInfoUser|UserInfoOrganization
    {
        $response = $this->transport->request(
            'GET',
            '/v1/oauth2/userinfo',
            [
            ],
            [
            ],
            null,
            'json',
            [
            ],
        );

        /** @var UserInfoUser|UserInfoOrganization $result */
        $result = Union::resolve($response, null, [], [UserInfoUser::class, UserInfoOrganization::class]);

        return $result;
    }
}