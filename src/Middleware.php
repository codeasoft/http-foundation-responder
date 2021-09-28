<?php

declare(strict_types=1);

namespace Tuzex\Responder;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Response\ResponseResource;

interface Middleware
{
    public function execute(ResponseResource $responseResource, Closure $nextMiddleware): Response;
}
