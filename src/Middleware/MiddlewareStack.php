<?php

declare(strict_types=1);

namespace Tuzex\Responder\Middleware;

use LogicException;
use Tuzex\Responder\Middleware;

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
            throw new LogicException('There is no other middleware');
        }

        return $middleware;
    }
}
