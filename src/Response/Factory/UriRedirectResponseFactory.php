<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Factory;

use Closure;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Http\UriProvider;
use Tuzex\Responder\Response\Definition\UriRedirect;
use Tuzex\Responder\Response\ResponseDefinition;
use Tuzex\Responder\Response\ResponseFactory;

final class UriRedirectResponseFactory implements ResponseFactory
{
    public function __construct(
        private UriProvider $uriProvider,
    ) {}

    public function create(ResponseDefinition $responseDefinition, Closure $nextResponseFactory): Response
    {
        if (! $responseDefinition instanceof UriRedirect) {
            return $nextResponseFactory($responseDefinition);
        }

        $httpConfig = $responseDefinition->httpConfig();

        return new RedirectResponse($this->uriProvider->provide(), $httpConfig->statusCode(), $httpConfig->headers());
    }
}
