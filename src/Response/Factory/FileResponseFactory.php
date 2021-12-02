<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Factory;

use Closure;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Response\Resource;
use Tuzex\Responder\Response\Resource\File;
use Tuzex\Responder\Response\ResponseFactory;

final class FileResponseFactory implements ResponseFactory
{
    public function create(Resource $resource, Closure $nextResponseFactory): Response
    {
        if (! $resource instanceof File) {
            return $nextResponseFactory($resource);
        }

        $httpConfig = $resource->httpConfig();

        return new BinaryFileResponse($resource->path, $httpConfig->statusCode(), $httpConfig->headers());
    }
}
