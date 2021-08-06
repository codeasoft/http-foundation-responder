<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Factory;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Response\Definition\Text;
use Tuzex\Responder\Response\ResponseDefinition;
use Tuzex\Responder\Response\ResponseFactory;

final class TextResponseFactory implements ResponseFactory
{
    public function create(ResponseDefinition $responseDefinition, Closure $nextResponseFactory): Response
    {
        if (! $responseDefinition instanceof Text) {
            return $nextResponseFactory($responseDefinition);
        }

        $httpConfig = $responseDefinition->httpConfig();

        return new Response($responseDefinition->body(), $httpConfig->statusCode(), $httpConfig->headers());
    }
}
