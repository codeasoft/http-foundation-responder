<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Bridge\Symfony\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Tuzex\Symfony\Responder\Result\HttpConfigs;

final class JsonResponseFactory
{
    public function create(iterable $data, HttpConfigs $httpConfigs): JsonResponse
    {
        return new JsonResponse($data, $httpConfigs->getStatusCode(), $httpConfigs->getHeaders());
    }
}
