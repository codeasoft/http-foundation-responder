<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Factory;

use Closure;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Tuzex\Responder\Response\Resource;
use Tuzex\Responder\Response\Resource\RouteRedirect;
use Tuzex\Responder\Response\ResponseFactory;

final class RouteRedirectResponseFactory implements ResponseFactory
{
    public function __construct(
        private UrlGeneratorInterface $urlGenerator,
    ) {}

    public function create(Resource $resource, Closure $nextResponseFactory): Response
    {
        if (! $resource instanceof RouteRedirect) {
            return $nextResponseFactory($resource);
        }

        $httpConfig = $resource->httpConfig();

        return new RedirectResponse($this->route($resource), $httpConfig->statusCode(), $httpConfig->headers());
    }

    private function route(RouteRedirect $resource): string
    {
        return $this->urlGenerator->generate($resource->route(), $resource->parameters());
    }
}
