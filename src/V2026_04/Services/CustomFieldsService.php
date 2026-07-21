<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\CustomField;
use Pago\V2026_04\Models\CustomFieldCreate;
use Pago\V2026_04\Models\CustomFieldCreateFactory;
use Pago\V2026_04\Models\CustomFieldFactory;
use Pago\V2026_04\Models\CustomFieldSortProperty;
use Pago\V2026_04\Models\CustomFieldType;
use Pago\V2026_04\Models\CustomFieldUpdate;
use Pago\V2026_04\Models\CustomFieldUpdateFactory;
use Pago\V2026_04\Models\ListResourceCustomField;

/**
 * CustomFields operations.
 */
final class CustomFieldsService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * List custom fields.
     *
     * **Scopes**: `custom_fields:read` `custom_fields:write`
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|null $query Filter by custom field name or slug.
     * @param CustomFieldType|list<CustomFieldType>|null $type Filter by custom field type.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<CustomFieldSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function list(
        string|array|null $organizationId = null,
        ?string $query = null,
        CustomFieldType|array|null $type = null,
        ?int $page = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): ListResourceCustomField {
        $response = $this->transport->request(
            'GET',
            '/v1/custom-fields/',
            [
            ],
            [
                'organization_id' => Json::encode($organizationId),
                'query' => Json::encode($query),
                'type' => Json::encode($type),
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

        $result = ListResourceCustomField::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List custom fields.
     *
     * Lazily iterates every page returned by {@see self::list()}.
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|null $query Filter by custom field name or slug.
     * @param CustomFieldType|list<CustomFieldType>|null $type Filter by custom field type.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @param list<CustomFieldSortProperty>|null $sorting Sorting criterion. Several criteria can be used simultaneously and will be applied in order. Add a minus sign `-` before the criteria name to sort by descending order.
     * @return Page<CustomField>
     */
    public function listPaginated(
        string|array|null $organizationId = null,
        ?string $query = null,
        CustomFieldType|array|null $type = null,
        ?int $limit = null,
        ?array $sorting = null,
    ): Page {
        /** @var \Closure(int): array{0: list<CustomField>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($organizationId, $query, $type, $limit, $sorting): array {
            $result = $this->list(
                organizationId: $organizationId,
                query: $query,
                type: $type,
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
     * Create a custom field.
     *
     * **Scopes**: `custom_fields:write`
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function create(
        CustomFieldCreate $body,
    ): CustomField {
        $response = $this->transport->request(
            'POST',
            '/v1/custom-fields/',
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

        $result = CustomFieldFactory::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Get a custom field by ID.
     *
     * **Scopes**: `custom_fields:read` `custom_fields:write`
     *
     * @param $id The custom field ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function get(
        string $id,
    ): CustomField {
        $response = $this->transport->request(
            'GET',
            '/v1/custom-fields/{id}',
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

        $result = CustomFieldFactory::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Delete a custom field.
     *
     * **Scopes**: `custom_fields:write`
     *
     * @param $id The custom field ID.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function delete(
        string $id,
    ): void {
        $this->transport->request(
            'DELETE',
            '/v1/custom-fields/{id}',
            [
                'id' => Json::encode($id),
            ],
            [
            ],
            null,
            'none',
            [
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );
    }

    /**
     * Update a custom field.
     *
     * **Scopes**: `custom_fields:write`
     *
     * @param $id The custom field ID.
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function update(
        string $id,
        CustomFieldUpdate $body,
    ): CustomField {
        $response = $this->transport->request(
            'PATCH',
            '/v1/custom-fields/{id}',
            [
                'id' => Json::encode($id),
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

        $result = CustomFieldFactory::fromArray(Json::toMap($response));

        return $result;
    }
}