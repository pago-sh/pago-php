<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services\CustomerPortal;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\V2026_04\Models\CustomerOrganizationData;

/**
 * Organizations operations.
 */
final class OrganizationsService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * Get a customer portal's organization by slug.
     *
     * @param $slug The organization slug.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function get(
        string $slug,
    ): CustomerOrganizationData {
        $response = $this->transport->request(
            'GET',
            '/v1/customer-portal/organizations/{slug}',
            [
                'slug' => Json::encode($slug),
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

        $result = CustomerOrganizationData::fromArray(Json::toMap($response));

        return $result;
    }
}