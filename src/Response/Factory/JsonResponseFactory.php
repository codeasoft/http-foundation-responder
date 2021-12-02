<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Factory;

use Closure;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Response\Resource;
use Tuzex\Responder\Response\Resource\Payload\JsonDocument;
use Tuzex\Responder\Response\ResponseFactory;

final class JsonResponseFactory implements ResponseFactory
{
    public function create(Resource $resource, Closure $nextResponseFactory): Response
    {
        if (! $resource instanceof JsonDocument) {
            return $nextResponseFactory($resource);
        }

        $httpConfig = $resource->httpConfig();

        return new JsonResponse($resource->list, $httpConfig->statusCode(), $httpConfig->headers());
    }
}
