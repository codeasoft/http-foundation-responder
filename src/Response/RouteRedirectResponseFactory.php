<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response;

use Closure;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Tuzex\Responder\ResponseFactory;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\Redirect\RouteRedirect;

final class RouteRedirectResponseFactory implements ResponseFactory
{
    public function __construct(
        private UrlGeneratorInterface $urlGenerator,
    ) {}

    public function create(Result $result, Closure $next): Response
    {
        if (!$result instanceof RouteRedirect) {
            return $next($result);
        }

        $httpConfig = $result->httpConfig();

        return new RedirectResponse($this->route($result), $httpConfig->statusCode(), $httpConfig->headers());
    }

    public function route(RouteRedirect $result): string
    {
        return $this->urlGenerator->generate($result->name(), $result->parameters());
    }
}
