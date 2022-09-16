<?php

declare(strict_types=1);

namespace Codea\SmartReply;

use Closure;
use Codea\SmartReply\Response\Resource;
use Symfony\Component\HttpFoundation\Response;

interface Middleware
{
    public function execute(Resource $resource, Closure $nextMiddleware): Response;
}
