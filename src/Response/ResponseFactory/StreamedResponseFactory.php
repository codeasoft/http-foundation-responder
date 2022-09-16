<?php

declare(strict_types=1);

namespace Codea\SmartReply\Response\ResponseFactory;

use Closure;
use Codea\SmartReply\Http\HttpHeader\XAccelBufferingHttpHeader;
use Codea\SmartReply\Response\Resource;
use Codea\SmartReply\Response\Resource\Stream;
use Codea\SmartReply\Response\ResponseFactory;
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
