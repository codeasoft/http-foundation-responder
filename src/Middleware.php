<?php

declare(strict_types=1);

namespace Tuzex\Responder;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Response\Resource;

interface Middleware
{
    public function execute(Resource $resource, Closure $nextMiddleware): Response;
}
