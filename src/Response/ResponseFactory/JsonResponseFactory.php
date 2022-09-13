<?php

declare(strict_types=1);

namespace Codea\Responder\Response\ResponseFactory;

use Closure;
use Codea\Responder\Response\Resource;
use Codea\Responder\Response\Resource\Data\JsonData;
use Codea\Responder\Response\ResponseFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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
