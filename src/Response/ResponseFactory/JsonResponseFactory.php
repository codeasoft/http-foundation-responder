<?php

declare(strict_types=1);

namespace Codea\SmartReply\Response\ResponseFactory;

use Closure;
use Codea\SmartReply\Response\Resource;
use Codea\SmartReply\Response\Resource\Data\JsonData;
use Codea\SmartReply\Response\ResponseFactory;
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
