<?php

declare(strict_types=1);

namespace Codea\SmartReply\Response\ResponseFactory;

use Closure;
use Codea\SmartReply\Response\Resource;
use Codea\SmartReply\Response\Resource\Text;
use Codea\SmartReply\Response\ResponseFactory;
use Symfony\Component\HttpFoundation\Response;

final class TextResponseFactory implements ResponseFactory
{
    public function create(Resource $resource, Closure $nextResponseFactory): Response
    {
        if (! $resource instanceof Text) {
            return $nextResponseFactory($resource);
        }

        $httpConfig = $resource->httpConfig();

        return new Response($resource->content(), $httpConfig->statusCode(), $httpConfig->httpHeaders());
    }
}
