<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Response\ResponseFactory;

use Closure;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Termyn\SmartReply\Response\Resource;
use Termyn\SmartReply\Response\Resource\Redirect\UrlRedirect;
use Termyn\SmartReply\Response\ResponseFactory;

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
