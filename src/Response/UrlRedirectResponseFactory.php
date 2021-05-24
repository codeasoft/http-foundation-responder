<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response;

use Closure;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\ResponseFactory;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\Redirect\UrlRedirect;

final class UrlRedirectResponseFactory implements ResponseFactory
{
    public function create(Result $result, Closure $next): Response
    {
        if (! $result instanceof UrlRedirect) {
            return $next($result);
        }

        $httpConfig = $result->httpConfig();

        return new RedirectResponse($result->urlAddress(), $httpConfig->statusCode(), $httpConfig->headers());
    }
}
