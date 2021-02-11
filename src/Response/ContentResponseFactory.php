<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\ResponseFactory;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\Payload\Content;

final class ContentResponseFactory implements ResponseFactory
{
    public function create(Result $result, Closure $processor): Response
    {
        if (!$result instanceof Content) {
            return $processor($result);
        }

        $httpConfig = $result->httpConfig();

        return new Response($result->textBody(), $httpConfig->statusCode(), $httpConfig->headers());
    }
}
