<?php

declare(strict_types=1);

namespace Termyn\SmartReply;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Termyn\SmartReply\Middleware\ResponseProducer;
use Termyn\SmartReply\Response\Resource;

final class MiddlewareResponder implements Responder
{
    private Closure $processor;

    public function __construct(ResponseProducer $responseProducer, Middleware ...$middlewares)
    {
        $this->processor = fn () => null;
        $this->setup(
            ...array_merge([$responseProducer], $middlewares)
        );
    }

    private function setup(Middleware ...$middlewares): void
    {
        $processor = $this->processor;

        foreach ($middlewares as $middleware) {
            $this->processor = $processor = fn (Resource $resource): Response => $middleware->execute($resource, $processor);
        }
    }

    public function process(Resource $resource): Response
    {
        return ($this->processor)($resource);
    }
}
