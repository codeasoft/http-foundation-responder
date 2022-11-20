<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Response\ResponseFactory;

use Closure;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Termyn\SmartReply\Response\Resource;
use Termyn\SmartReply\Response\Resource\Redirect\RouteRedirect;
use Termyn\SmartReply\Response\ResponseFactory;

final class RouteRedirectResponseFactory implements ResponseFactory
{
    public function __construct(
        private UrlGeneratorInterface $urlGenerator,
    ) {
    }

    public function create(Resource $resource, Closure $nextResponseFactory): Response
    {
        if (! $resource instanceof RouteRedirect) {
            return $nextResponseFactory($resource);
        }

        $httpConfig = $resource->httpConfig();
        $targetRoute = $this->urlGenerator->generate($resource->route, $resource->parameters);

        return new RedirectResponse($targetRoute, $httpConfig->statusCode(), $httpConfig->httpHeaders());
    }
}
