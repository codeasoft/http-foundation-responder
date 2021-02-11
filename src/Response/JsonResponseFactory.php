<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response;

use Closure;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\ResponseFactory;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\Payload\JsonData;

final class JsonResponseFactory implements ResponseFactory
{
    public function create(Result $result, Closure $processor): Response
    {
        if (!$result instanceof JsonData) {
            return $processor($result);
        }

        $httpConfig = $result->httpConfig();

        return new JsonResponse($result->iterableData(), $httpConfig->statusCode(), $httpConfig->headers());
    }
}
