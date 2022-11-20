<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Response\ResponseFactory;

use Closure;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Termyn\SmartReply\Response\Resource;
use Termyn\SmartReply\Response\Resource\Data\JsonData;
use Termyn\SmartReply\Response\ResponseFactory;

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
