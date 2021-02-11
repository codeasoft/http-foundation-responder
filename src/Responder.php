<?php

declare(strict_types=1);

namespace Tuzex\Responder;

use Symfony\Component\HttpFoundation\Response;

final class Responder
{
    public function __construct(
        private MiddlewarePipe $middlewarePipe
    ) {}

    public function process(Result $result): Response
    {
        return ($this->middlewarePipe->entrypoint())($result);
    }
}
