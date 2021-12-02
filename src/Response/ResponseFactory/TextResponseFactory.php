<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\ResponseFactory;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Response\Resource;
use Tuzex\Responder\Response\Resource\Text;
use Tuzex\Responder\Response\ResponseFactory;

final class TextResponseFactory implements ResponseFactory
{
    public function create(Resource $resource, Closure $nextResponseFactory): Response
    {
        if (! $resource instanceof Text) {
            return $nextResponseFactory($resource);
        }

        $httpConfig = $resource->httpConfig();

        return new Response($resource->content, $httpConfig->statusCode(), $httpConfig->headers());
    }
}
