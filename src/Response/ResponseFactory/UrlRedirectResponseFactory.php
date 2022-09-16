<?php

declare(strict_types=1);

namespace Codea\SmartReply\Response\ResponseFactory;

use Closure;
use Codea\SmartReply\Response\Resource;
use Codea\SmartReply\Response\Resource\Redirect\UrlRedirect;
use Codea\SmartReply\Response\ResponseFactory;
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
