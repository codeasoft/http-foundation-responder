<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\ResponseFactory;

use Closure;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Response\Resource;
use Tuzex\Responder\Response\Resource\Data\JsonData;
use Tuzex\Responder\Response\ResponseFactory;

final class JsonResponseFactory implements ResponseFactory
{
    public function create(Resource $resource, Closure $nextResponseFactory): Response
    {
        if (! $resource instanceof JsonData) {
            return $nextResponseFactory($resource);
        }

        $httpConfig = $resource->httpConfig();

        return new JsonResponse($resource->datalist(), $httpConfig->statusCode(), $httpConfig->httpHeaders());
    }
}
