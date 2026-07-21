<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services\CustomerPortal;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\LicenseKeyActivate;
use Pago\V2026_04\Models\LicenseKeyActivationRead;
use Pago\V2026_04\Models\LicenseKeyDeactivate;
use Pago\V2026_04\Models\LicenseKeyRead;
use Pago\V2026_04\Models\LicenseKeyValidate;
use Pago\V2026_04\Models\LicenseKeyWithActivations;
use Pago\V2026_04\Models\ListResourceLicenseKeyRead;
use Pago\V2026_04\Models\ValidatedLicenseKey;

/**
 * LicenseKeys operations.
 */
final class LicenseKeysService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * **Scopes**: `customer_portal:read` `customer_portal:write`
     *
     * @param string|null $benefitId Filter by a specific benefit
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\Unauthorized on HTTP 401
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function list(
        ?string $benefitId = null,
        ?int $page = null,
        ?int $limit = null,
    ): ListResourceLicenseKeyRead {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-portal/license-keys/',
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
                401 => \Pago\V2026_04\Errors\Unauthorized::class,
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = ListResourceLicenseKeyRead::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * **Scopes**: `customer_portal:read` `customer_portal:write`
     *
     * Lazily iterates every page returned by {@see self::list()}.
     *
     * @param string|null $benefitId Filter by a specific benefit
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @return Page<LicenseKeyRead>
     */
    public function listPaginated(
        ?string $benefitId = null,
        ?int $limit = null,
    ): Page {
        /** @var \Closure(int): array{0: list<LicenseKeyRead>, 1: int} $fetcher */
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

    /**
     * Get a license key.
     *
     * **Scopes**: `customer_portal:read` `customer_portal:write`
     *
     * @param $id id
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function get(
        string $id,
    ): LicenseKeyWithActivations {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-portal/license-keys/{id}',
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

        $result = LicenseKeyWithActivations::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Validate a license key.
     *
     * > This endpoint doesn't require authentication and can be safely used on a public
     * > client, like a desktop application or a mobile app.
     * > If you plan to validate a license key on a server, use the `/v1/license-keys/validate`
     * > endpoint instead.
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function validate(
        LicenseKeyValidate $body,
    ): ValidatedLicenseKey {
        $response = $this->transport->request(
            'POST',
            '/v1/customer-portal/license-keys/validate',
            [
            ],
            [
            ],
            Json::encode($body),
            'json',
            [
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = ValidatedLicenseKey::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Activate a license key instance.
     *
     * > This endpoint doesn't require authentication and can be safely used on a public
     * > client, like a desktop application or a mobile app.
     * > If you plan to validate a license key on a server, use the `/v1/license-keys/activate`
     * > endpoint instead.
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\NotPermitted on HTTP 403
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function activate(
        LicenseKeyActivate $body,
    ): LicenseKeyActivationRead {
        $response = $this->transport->request(
            'POST',
            '/v1/customer-portal/license-keys/activate',
            [
            ],
            [
            ],
            Json::encode($body),
            'json',
            [
                403 => \Pago\V2026_04\Errors\NotPermitted::class,
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = LicenseKeyActivationRead::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Deactivate a license key instance.
     *
     * > This endpoint doesn't require authentication and can be safely used on a public
     * > client, like a desktop application or a mobile app.
     * > If you plan to validate a license key on a server, use the `/v1/license-keys/deactivate`
     * > endpoint instead.
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function deactivate(
        LicenseKeyDeactivate $body,
    ): void {
        $this->transport->request(
            'POST',
            '/v1/customer-portal/license-keys/deactivate',
            [
            ],
            [
            ],
            Json::encode($body),
            'none',
            [
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );
    }
}