<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Middleware;

use LogicException;
use Tuzex\Symfony\Responder\Middlewares;

final class MiddlewareStack
{
    private array $middlewares;

    public function __construct(Middleware ...$middlewares)
    {
        $this->middlewares = $middlewares;
    }

    public function next(): Middleware
    {
        $middleware = array_shift($this->middlewares);
        if (!$middleware) {
            throw new LogicException(sprintf('There is no other middleware. Check implementation of "%s" and "%s".', Middlewares::class, TransformResultMiddleware::class));
        }

        return $middleware;
    }
}
