<?php

declare(strict_types=1);

namespace Codea\Responder\Middleware;

use Closure;
use Codea\Responder\Exception\UnknownResourceException;
use Codea\Responder\Middleware;
use Codea\Responder\Response\Resource;
use Codea\Responder\Response\ResponseFactory;
use Symfony\Component\HttpFoundation\Response;

final class ResponseProducer implements Middleware
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
