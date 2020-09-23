<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder;

use Symfony\Component\HttpFoundation\Response;
use Tuzex\Symfony\Responder\Result\Result;

final class Responder
{
    private Middlewares $middlewares;

    public function __construct(Middlewares $middlewares)
    {
        $this->middlewares = $middlewares;
    }

    public function reply(Result $result): Response
    {
        $stack = $this->middlewares->stack();
        $middleware = $stack->next();

        return $middleware->execute($result, $stack);
    }
}
