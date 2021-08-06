<?php

declare(strict_types=1);

namespace Tuzex\Responder;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Response\ResponseDefinition;

interface Middleware
{
    public function execute(ResponseDefinition $responseDefinition, Closure $nextMiddleware): Response;
}
