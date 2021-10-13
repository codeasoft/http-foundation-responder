<?php

declare(strict_types=1);

namespace Tuzex\Responder;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Middleware\ResponseProducer;
use Tuzex\Responder\Response\Resource;

final class ContextResponder implements Responder
{
    private Closure $processor;

    public function __construct(ResponseProducer $responseProducer)
    {
        $this->processor = fn () => null;
        $this->extend($responseProducer);
    }

    public function process(Resource $resource): Response
    {
        return ($this->processor)($resource);
    }

    public function extend(Middleware ...$middlewares): void
    {
        $processor = $this->processor;

        foreach ($middlewares as $middleware) {
            $this->processor = $processor = fn (Resource $resource): Response => $middleware->execute($resource, $processor);
        }
    }
}
