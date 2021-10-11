<?php

declare(strict_types=1);

namespace Tuzex\Responder\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Exception\UnknownResourceException;
use Tuzex\Responder\Middleware;
use Tuzex\Responder\Response\Resource;
use Tuzex\Responder\Response\ResponseFactory;

final class CreateResponseMiddleware implements Middleware
{
    private Closure $producer;

    public function __construct(ResponseFactory ...$factories)
    {
        $producer = fn (Resource $resource) => throw new UnknownResourceException($resource);

        foreach ($factories as $factory) {
            $this->producer = $producer = fn (Resource $resource): Response => $factory->create($resource, $producer);
        }
    }

    public function execute(Resource $resource, Closure $nextMiddleware): Response
    {
        return ($this->producer)($resource);
    }
}
