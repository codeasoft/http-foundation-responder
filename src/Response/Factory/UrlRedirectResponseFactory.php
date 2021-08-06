<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Factory;

use Closure;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Response\Definition\UrlRedirect;
use Tuzex\Responder\Response\ResponseDefinition;
use Tuzex\Responder\Response\ResponseFactory;

final class UrlRedirectResponseFactory implements ResponseFactory
{
    public function create(ResponseDefinition $responseDefinition, Closure $nextResponseFactory): Response
    {
        if (! $responseDefinition instanceof UrlRedirect) {
            return $nextResponseFactory($responseDefinition);
        }

        $httpConfig = $responseDefinition->httpConfig();

        return new RedirectResponse($responseDefinition->url(), $httpConfig->statusCode(), $httpConfig->headers());
    }
}
