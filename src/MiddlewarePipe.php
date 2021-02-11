<?php

declare(strict_types=1);

namespace Tuzex\Responder;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Middleware\CreateResponseMiddleware;

final class MiddlewarePipe
{
    private array $middlewares;

    public function __construct(CreateResponseMiddleware $middleware)
    {
        $this->middlewares[$middleware::class] = $middleware;
    }

    public function entrypoint(): Closure
    {
        $pipe = static fn (Result $result) => null;

        foreach ($this->middlewares as $middleware) {
            $pipe = static fn (Result $result): Response => $middleware->execute($result, $pipe);
        }

        return $pipe;
    }

    public function add(Middleware ...$middlewares): void
    {
        foreach ($middlewares as $middleware) {
            $this->middlewares[$middleware::class] = $middleware;
        }
    }
}
