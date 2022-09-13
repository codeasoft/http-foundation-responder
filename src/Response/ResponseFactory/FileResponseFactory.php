<?php

declare(strict_types=1);

namespace Codea\Responder\Response\ResponseFactory;

use Closure;
use Codea\Responder\Response\Resource;
use Codea\Responder\Response\Resource\File;
use Codea\Responder\Response\ResponseFactory;
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
