<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Factory;

use Closure;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Http\UriProvider;
use Tuzex\Responder\Response\Resource;
use Tuzex\Responder\Response\Resource\UriRedirect;
use Tuzex\Responder\Response\ResponseFactory;

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

        return new RedirectResponse($this->uriProvider->provide(), $httpConfig->statusCode(), $httpConfig->headers());
    }
}
