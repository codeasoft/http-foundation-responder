<?php

declare(strict_types=1);

namespace Codea\SmartReply\Response\ResponseFactory;

use Closure;
use Codea\SmartReply\Response\Resource;
use Codea\SmartReply\Response\Resource\File;
use Codea\SmartReply\Response\ResponseFactory;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

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
