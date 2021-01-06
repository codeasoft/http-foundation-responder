<?php

declare(strict_types=1);

namespace Tuzex\Responder;

use Symfony\Component\HttpFoundation\Response;

final class Responder
{
    public function __construct(
        private Middlewares $middlewares
    ) {}

    public function reply(Result $result): Response
    {
        $stack = $this->middlewares->stack();
        $middleware = $stack->next();

        return $middleware->execute($result, $stack);
    }
}
