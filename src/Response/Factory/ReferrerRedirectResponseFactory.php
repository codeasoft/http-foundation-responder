<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Factory;

use Closure;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Http\ReferrerProvider;
use Tuzex\Responder\Response\Resource\ReferrerRedirect;
use Tuzex\Responder\Response\ResponseFactory;
use Tuzex\Responder\Response\ResponseResource;

final class ReferrerRedirectResponseFactory implements ResponseFactory
{
    public function __construct(
        private ReferrerProvider $referrerProvider,
    ) {}

    public function create(ResponseResource $responseResource, Closure $nextResponseFactory): Response
    {
        if (! $responseResource instanceof ReferrerRedirect) {
            return $nextResponseFactory($responseResource);
        }

        $httpConfig = $responseResource->httpConfig();

        return new RedirectResponse($this->referrerProvider->provide(), $httpConfig->statusCode(), $httpConfig->headers());
    }
}
