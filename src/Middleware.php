<?php

declare(strict_types=1);

namespace Codea\Responder;

use Closure;
use Codea\Responder\Response\Resource;
use Symfony\Component\HttpFoundation\Response;

interface Middleware
{
    public function execute(Resource $resource, Closure $nextMiddleware): Response;
}
