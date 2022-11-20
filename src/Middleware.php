<?php

declare(strict_types=1);

namespace Termyn\SmartReply;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Termyn\SmartReply\Response\Resource;

interface Middleware
{
    public function execute(Resource $resource, Closure $nextMiddleware): Response;
}
