<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Factory;

use Closure;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Http\ReferrerProvider;
use Tuzex\Responder\Response\Resource;
use Tuzex\Responder\Response\Resource\ReferrerRedirect;
use Tuzex\Responder\Response\ResponseFactory;

final class ReferrerRedirectResponseFactory implements ResponseFactory
{
    public function __construct(
        private ReferrerProvider $referrerProvider,
    ) {}

    public function create(Resource $resource, Closure $nextResponseFactory): Response
    {
        if (! $resource instanceof ReferrerRedirect) {
            return $nextResponseFactory($resource);
        }

        $httpConfig = $resource->httpConfig();

        return new RedirectResponse($this->referrerProvider->provide(), $httpConfig->statusCode(), $httpConfig->headers());
    }
}
