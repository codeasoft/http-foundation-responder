<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Response\ResponseFactory;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Termyn\SmartReply\Http\HttpHeader\XAccelBufferingHttpHeader;
use Termyn\SmartReply\Response\Resource;
use Termyn\SmartReply\Response\Resource\Stream;
use Termyn\SmartReply\Response\ResponseFactory;

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
