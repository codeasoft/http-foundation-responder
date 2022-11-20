<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Termyn\SmartReply\Exception\UnknownResourceException;
use Termyn\SmartReply\Middleware;
use Termyn\SmartReply\Response\Resource;
use Termyn\SmartReply\Response\ResponseFactory;

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
