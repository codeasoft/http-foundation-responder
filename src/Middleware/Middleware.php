<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Tuzex\Symfony\Responder\Result\Result;

interface Middleware
{
    public function execute(Result $result, MiddlewareStack $stack): Response;
}
