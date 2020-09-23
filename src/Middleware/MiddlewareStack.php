<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Middleware;

use LogicException;
use Tuzex\Symfony\Responder\Middlewares;

final class MiddlewareStack
{
    private array $middlewares;

    /**
     * @param Middleware[] $middlewares
     */
    public function __construct(array $middlewares)
    {
        $this->middlewares = array_filter($middlewares, fn ($middleware): bool => $middleware instanceof Middleware);
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
