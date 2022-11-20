<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Response\ResponseFactory;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Termyn\SmartReply\Response\Resource;
use Termyn\SmartReply\Response\Resource\Text;
use Termyn\SmartReply\Response\ResponseFactory;

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
