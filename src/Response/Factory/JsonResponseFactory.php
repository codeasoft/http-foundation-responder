<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Factory;

use Closure;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Response\Resource\JsonDocument;
use Tuzex\Responder\Response\ResponseFactory;
use Tuzex\Responder\Response\ResponseResource;

final class JsonResponseFactory implements ResponseFactory
{
    public function create(ResponseResource $responseResource, Closure $nextResponseFactory): Response
    {
        if (! $responseResource instanceof JsonDocument) {
            return $nextResponseFactory($responseResource);
        }

        $httpConfig = $responseResource->httpConfig();

        return new JsonResponse($responseResource->payload(), $httpConfig->statusCode(), $httpConfig->headers());
    }
}
