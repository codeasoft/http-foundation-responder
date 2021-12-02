<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Factory;

use Closure;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Response\Resource;
use Tuzex\Responder\Response\Resource\Redirect\UrlRedirect;
use Tuzex\Responder\Response\ResponseFactory;

final class UrlRedirectResponseFactory implements ResponseFactory
{
    public function create(Resource $resource, Closure $nextResponseFactory): Response
    {
        if (! $resource instanceof UrlRedirect) {
            return $nextResponseFactory($resource);
        }

        $httpConfig = $resource->httpConfig();

        return new RedirectResponse($resource->url, $httpConfig->statusCode(), $httpConfig->headers());
    }
}
