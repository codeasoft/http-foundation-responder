<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Factory;

use Closure;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Tuzex\Responder\Response\Resource\RouteRedirect;
use Tuzex\Responder\Response\ResponseFactory;
use Tuzex\Responder\Response\ResponseResource;

final class RouteRedirectResponseFactory implements ResponseFactory
{
    public function __construct(
        private UrlGeneratorInterface $urlGenerator,
    ) {}

    public function create(ResponseResource $responseResource, Closure $nextResponseFactory): Response
    {
        if (! $responseResource instanceof RouteRedirect) {
            return $nextResponseFactory($responseResource);
        }

        $httpConfig = $responseResource->httpConfig();

        return new RedirectResponse($this->route($responseResource), $httpConfig->statusCode(), $httpConfig->headers());
    }

    private function route(RouteRedirect $responseResource): string
    {
        return $this->urlGenerator->generate($responseResource->name(), $responseResource->parameters());
    }
}
