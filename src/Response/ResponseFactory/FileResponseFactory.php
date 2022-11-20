<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Response\ResponseFactory;

use Closure;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Termyn\SmartReply\Response\Resource;
use Termyn\SmartReply\Response\Resource\File;
use Termyn\SmartReply\Response\ResponseFactory;

final class FileResponseFactory implements ResponseFactory
{
    public function create(Resource $resource, Closure $nextResponseFactory): Response
    {
        if (! $resource instanceof File) {
            return $nextResponseFactory($resource);
        }

        $httpConfig = $resource->httpConfig();

        return new BinaryFileResponse($resource->filepath, $httpConfig->statusCode(), $httpConfig->httpHeaders());
    }
}
