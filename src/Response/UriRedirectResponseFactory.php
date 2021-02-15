<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response;

use Closure;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Http\UriProvider;
use Tuzex\Responder\ResponseFactory;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\Redirect\UriRedirect;

final class UriRedirectResponseFactory implements ResponseFactory
{
    public function __construct(
        private UriProvider $uriProvider,
    ) {}

    public function create(Result $result, Closure $next): Response
    {
        if (!$result instanceof UriRedirect) {
            return $next($result);
        }

        $httpConfig = $result->httpConfig();

        return new RedirectResponse($this->uriProvider->provide(), $httpConfig->statusCode(), $httpConfig->headers());
    }
}
