<?php

declare(strict_types=1);

namespace Codea\SmartReply\Response\ResponseFactory;

use Closure;
use Codea\SmartReply\Response\Resource;
use Codea\SmartReply\Response\Resource\Redirect\RouteRedirect;
use Codea\SmartReply\Response\ResponseFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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
        $targetRoute = $this->urlGenerator->generate($resource->route, $resource->parameters);

        return new RedirectResponse($targetRoute, $httpConfig->statusCode(), $httpConfig->httpHeaders());
    }
}
