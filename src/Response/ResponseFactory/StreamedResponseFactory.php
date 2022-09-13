<?php

declare(strict_types=1);

namespace Codea\Responder\Response\ResponseFactory;

use Closure;
use Codea\Responder\Http\HttpHeader\XAccelBufferingHttpHeader;
use Codea\Responder\Response\Resource;
use Codea\Responder\Response\Resource\Stream;
use Codea\Responder\Response\ResponseFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

final class StreamedResponseFactory implements ResponseFactory
{
    public function create(Resource $resource, Closure $nextResponseFactory): Response
    {
        if (! $resource instanceof Stream) {
            return $nextResponseFactory($resource);
        }

        $httpConfig = $resource->httpConfig();
        $httpConfig = $httpConfig->extend(XAccelBufferingHttpHeader::YES);

        return new StreamedResponse($resource->callback(), $httpConfig->statusCode(), $httpConfig->httpHeaders());
    }
}
