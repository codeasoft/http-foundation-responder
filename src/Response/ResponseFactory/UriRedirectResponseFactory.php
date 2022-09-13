<?php

declare(strict_types=1);

namespace Codea\Responder\Response\ResponseFactory;

use Closure;
use Codea\Responder\Http\UriProvider;
use Codea\Responder\Response\Resource;
use Codea\Responder\Response\Resource\Redirect\UriRedirect;
use Codea\Responder\Response\ResponseFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

final class UriRedirectResponseFactory implements ResponseFactory
{
    public function __construct(
        private UriProvider $uriProvider,
    ) {}

    public function create(Resource $resource, Closure $nextResponseFactory): Response
    {
        if (! $resource instanceof UriRedirect) {
            return $nextResponseFactory($resource);
        }

        $httpConfig = $resource->httpConfig();

        return new RedirectResponse($this->uriProvider->provide(), $httpConfig->statusCode(), $httpConfig->httpHeaders());
    }
}
