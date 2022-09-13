<?php

declare(strict_types=1);

namespace Codea\Responder\Response\ResponseFactory;

use Closure;
use Codea\Responder\Response\Resource;
use Codea\Responder\Response\Resource\Redirect\UrlRedirect;
use Codea\Responder\Response\ResponseFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

final class UrlRedirectResponseFactory implements ResponseFactory
{
    public function create(Resource $resource, Closure $nextResponseFactory): Response
    {
        if (! $resource instanceof UrlRedirect) {
            return $nextResponseFactory($resource);
        }

        $httpConfig = $resource->httpConfig();

        return new RedirectResponse($resource->url, $httpConfig->statusCode(), $httpConfig->httpHeaders());
    }
}
