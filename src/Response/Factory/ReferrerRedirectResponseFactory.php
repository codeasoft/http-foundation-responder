<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Factory;

use Closure;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Http\ReferrerProvider;
use Tuzex\Responder\Response\Definition\ReferrerRedirect;
use Tuzex\Responder\Response\ResponseDefinition;
use Tuzex\Responder\Response\ResponseFactory;

final class ReferrerRedirectResponseFactory implements ResponseFactory
{
    public function __construct(
        private ReferrerProvider $referrerProvider,
    ) {}

    public function create(ResponseDefinition $responseDefinition, Closure $nextResponseFactory): Response
    {
        if (! $responseDefinition instanceof ReferrerRedirect) {
            return $nextResponseFactory($responseDefinition);
        }

        $httpConfig = $responseDefinition->httpConfig();

        return new RedirectResponse($this->referrerProvider->provide(), $httpConfig->statusCode(), $httpConfig->headers());
    }
}
