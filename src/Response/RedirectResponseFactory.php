<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response;

use Closure;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\ResponseFactory;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\Redirect\UrlRedirect;

final class RedirectResponseFactory implements ResponseFactory
{
    public function create(Result $result, Closure $processor): Response
    {
        if (!$result instanceof UrlRedirect) {
            return $processor($result);
        }

        $httpConfig = $result->httpConfig();

        return new RedirectResponse($result->urlAddress(), $httpConfig->statusCode(), $httpConfig->headers());
    }
}