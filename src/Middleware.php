<?php

declare(strict_types=1);

namespace Tuzex\Responder;

use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Middleware\MiddlewareStack;

interface Middleware
{
    public function execute(Result $result, MiddlewareStack $stack): Response;
}
