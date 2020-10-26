<?php

declare(strict_types=1);

namespace Tuzex\Responder\Bridge\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Tuzex\Responder\Result\HttpConfig;

final class JsonResponseFactory
{
    public function create(iterable $data, HttpConfig $httpConfig): JsonResponse
    {
        return new JsonResponse($data, $httpConfig->getStatusCode(), $httpConfig->getHeaders());
    }
}
