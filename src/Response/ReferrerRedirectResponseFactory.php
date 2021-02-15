<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response;

use Closure;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Http\ReferrerProvider;
use Tuzex\Responder\ResponseFactory;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\Redirect\ReferrerRedirect;

final class ReferrerRedirectResponseFactory implements ResponseFactory
{
    public function __construct(
        private ReferrerProvider $referrerProvider,
    ) {}

    public function create(Result $result, Closure $next): Response
    {
        if (!$result instanceof ReferrerRedirect) {
            return $next($result);
        }

        $httpConfig = $result->httpConfig();

        return new RedirectResponse($this->referrerProvider->provide(), $httpConfig->statusCode(), $httpConfig->headers());
    }
}
