<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\ResponseFactory;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Tuzex\Responder\Http\HttpHeader\XAccelBuffering;
use Tuzex\Responder\Response\Resource;
use Tuzex\Responder\Response\Resource\Stream;
use Tuzex\Responder\Response\ResponseFactory;

final class StreamedResponseFactory implements ResponseFactory
{
    public function create(Resource $resource, Closure $nextResponseFactory): Response
    {
        if (! $resource instanceof Stream) {
            return $nextResponseFactory($resource);
        }

        $httpConfig = $resource->httpConfig();
        $httpConfig = $httpConfig->extend(XAccelBuffering::YES);

        return new StreamedResponse($resource->callback(), $httpConfig->statusCode(), $httpConfig->httpHeaders());
    }
}
