<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Factory;

use Closure;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Tuzex\Responder\Response\Definition\RouteRedirect;
use Tuzex\Responder\Response\ResponseDefinition;
use Tuzex\Responder\Response\ResponseFactory;

final class RouteRedirectResponseFactory implements ResponseFactory
{
    public function __construct(
        private UrlGeneratorInterface $urlGenerator,
    ) {}

    public function create(ResponseDefinition $responseDefinition, Closure $nextResponseFactory): Response
    {
        if (! $responseDefinition instanceof RouteRedirect) {
            return $nextResponseFactory($responseDefinition);
        }

        $httpConfig = $responseDefinition->httpConfig();

        return new RedirectResponse($this->route($responseDefinition), $httpConfig->statusCode(), $httpConfig->headers());
    }

    private function route(RouteRedirect $responseDefinition): string
    {
        return $this->urlGenerator->generate($responseDefinition->name(), $responseDefinition->parameters());
    }
}
