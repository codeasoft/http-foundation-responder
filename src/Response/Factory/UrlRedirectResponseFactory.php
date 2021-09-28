<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Factory;

use Closure;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Response\Resource\UrlRedirect;
use Tuzex\Responder\Response\ResponseFactory;
use Tuzex\Responder\Response\ResponseResource;

final class UrlRedirectResponseFactory implements ResponseFactory
{
    public function create(ResponseResource $responseResource, Closure $nextResponseFactory): Response
    {
        if (! $responseResource instanceof UrlRedirect) {
            return $nextResponseFactory($responseResource);
        }

        $httpConfig = $responseResource->httpConfig();

        return new RedirectResponse($responseResource->url(), $httpConfig->statusCode(), $httpConfig->headers());
    }
}
