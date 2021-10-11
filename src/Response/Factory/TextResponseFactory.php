<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Factory;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Response\Resource\Text;
use Tuzex\Responder\Response\ResponseFactory;
use Tuzex\Responder\Response\ResponseResource;

final class TextResponseFactory implements ResponseFactory
{
    public function create(ResponseResource $responseResource, Closure $nextResponseFactory): Response
    {
        if (! $responseResource instanceof Text) {
            return $nextResponseFactory($responseResource);
        }

        $httpConfig = $responseResource->httpConfig();

        return new Response($responseResource->payload(), $httpConfig->statusCode(), $httpConfig->headers());
    }
}
