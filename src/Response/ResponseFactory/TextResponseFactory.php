<?php

declare(strict_types=1);

namespace Codea\Responder\Response\ResponseFactory;

use Closure;
use Codea\Responder\Response\Resource;
use Codea\Responder\Response\Resource\Text;
use Codea\Responder\Response\ResponseFactory;
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
