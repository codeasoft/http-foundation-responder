<?php

declare(strict_types=1);

namespace Tuzex\Responder\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Exception\UnknownResponseResourceException;
use Tuzex\Responder\Middleware;
use Tuzex\Responder\Response\ResponseFactory;
use Tuzex\Responder\Response\ResponseResource;

final class CreateResponseMiddleware implements Middleware
{
    private Closure $producer;

    public function __construct(ResponseFactory ...$factories)
    {
        $producer = fn (ResponseResource $responseResource) => throw new UnknownResponseResourceException($responseResource);

        foreach ($factories as $factory) {
            $this->producer = $producer = fn (ResponseResource $responseResource): Response => $factory->create($responseResource, $producer);
        }
    }

    public function execute(ResponseResource $responseResource, Closure $nextMiddleware): Response
    {
        return ($this->producer)($responseResource);
    }
}
