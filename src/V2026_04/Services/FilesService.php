<?php

declare(strict_types=1);

namespace Pago\V2026_04\Services;

use Pago\Http\Transport;
use Pago\Serialization\Json;
use Pago\Serialization\Union;
use Pago\Pagination\Page;
use Pago\V2026_04\Models\FileCreate;
use Pago\V2026_04\Models\FileCreateFactory;
use Pago\V2026_04\Models\FilePatch;
use Pago\V2026_04\Models\FileRead;
use Pago\V2026_04\Models\FileReadFactory;
use Pago\V2026_04\Models\FileUpload;
use Pago\V2026_04\Models\FileUploadCompleted;
use Pago\V2026_04\Models\ListResourceFileRead;

/**
 * Files operations.
 */
final class FilesService
{

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * List files.
     *
     * **Scopes**: `files:read` `files:write`
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $ids Filter by file ID.
     * @param int|null $page Page number, defaults to 1.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function list(
        string|array|null $organizationId = null,
        string|array|null $ids = null,
        ?int $page = null,
        ?int $limit = null,
    ): ListResourceFileRead {
        $response = $this->transport->request(
            'GET',
            '/v1/files/',
            [
            ],
            [
                'organization_id' => Json::encode($organizationId),
                'ids' => Json::encode($ids),
                'page' => Json::encode($page),
                'limit' => Json::encode($limit),
            ],
            null,
            'json',
            [
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );

        $result = ListResourceFileRead::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * List files.
     *
     * Lazily iterates every page returned by {@see self::list()}.
     *
     * @param string|list<string>|null $organizationId Filter by organization ID.
     * @param string|list<string>|null $ids Filter by file ID.
     * @param int|null $limit Size of a page, defaults to 10. Maximum is 100.
     * @return Page<FileRead>
     */
    public function listPaginated(
        string|array|null $organizationId = null,
        string|array|null $ids = null,
        ?int $limit = null,
    ): Page {
        /** @var \Closure(int): array{0: list<FileRead>, 1: int} $fetcher */
        $fetcher = function (int $page) use ($organizationId, $ids, $limit): array {
            $result = $this->list(
                organizationId: $organizationId,
                ids: $ids,
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
     * Create a file.
     *
     * **Scopes**: `files:write`
     *
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function create(
        FileCreate $body,
    ): FileUpload {
        $response = $this->transport->request(
            'POST',
            '/v1/files/',
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

        $result = FileUpload::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Complete a file upload.
     *
     * **Scopes**: `files:write`
     *
     * @param $idPath The file ID.
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\NotPermitted on HTTP 403
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function uploaded(
        string $idPath,
        FileUploadCompleted $body,
    ): FileRead {
        $response = $this->transport->request(
            'POST',
            '/v1/files/{id}/uploaded',
            [
                'id' => Json::encode($idPath),
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

        $result = FileReadFactory::fromArray(Json::toMap($response));

        return $result;
    }

    /**
     * Delete a file.
     *
     * **Scopes**: `files:write`
     *
     * @param $id id
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\NotPermitted on HTTP 403
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function delete(
        string $id,
    ): void {
        $this->transport->request(
            'DELETE',
            '/v1/files/{id}',
            [
                'id' => Json::encode($id),
            ],
            [
            ],
            null,
            'none',
            [
                403 => \Pago\V2026_04\Errors\NotPermitted::class,
                404 => \Pago\V2026_04\Errors\ResourceNotFound::class,
                422 => \Pago\V2026_04\Errors\HTTPValidationError::class,
            ],
        );
    }

    /**
     * Update a file.
     *
     * **Scopes**: `files:write`
     *
     * @param $id The file ID.
     * @param $body Request body.
     *
     * @throws \Pago\Exception\PagoNetworkException on transport failure
     * @throws \Pago\Exception\PagoRateLimitException on HTTP 429
     * @throws \Pago\Exception\PagoServerException on HTTP 5xx
     * @throws \Pago\V2026_04\Errors\NotPermitted on HTTP 403
     * @throws \Pago\V2026_04\Errors\ResourceNotFound on HTTP 404
     * @throws \Pago\V2026_04\Errors\HTTPValidationError on HTTP 422
     */
    public function update(
        string $id,
        FilePatch $body,
    ): FileRead {
        $response = $this->transport->request(
            'PATCH',
            '/v1/files/{id}',
            [
                'id' => Json::encode($id),
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

        $result = FileReadFactory::fromArray(Json::toMap($response));

        return $result;
    }
}