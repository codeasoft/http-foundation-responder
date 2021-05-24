<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response;

use Closure;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\ResponseFactory;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\Payload\File;

final class FileResponseFactory implements ResponseFactory
{
    public function create(Result $result, Closure $next): Response
    {
        if (! $result instanceof File) {
            return $next($result);
        }

        $httpConfig = $result->httpConfig();

        return new BinaryFileResponse($result->filePath(), $httpConfig->statusCode(), $httpConfig->headers());
    }
}
