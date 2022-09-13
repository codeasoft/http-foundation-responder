<?php

declare(strict_types=1);

namespace Codea\Responder\Response\ResponseFactory;

use Closure;
use Codea\Responder\Http\ReferrerProvider;
use Codea\Responder\Response\Resource;
use Codea\Responder\Response\Resource\Redirect\ReferrerRedirect;
use Codea\Responder\Response\ResponseFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

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

        return new RedirectResponse($this->referrerProvider->provide(), $httpConfig->statusCode(), $httpConfig->httpHeaders());
    }
}
