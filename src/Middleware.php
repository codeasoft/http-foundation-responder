<?php

declare(strict_types=1);

namespace Tuzex\Responder;

use Closure;
use Symfony\Component\HttpFoundation\Response;

interface Middleware
{
    public function execute(Result $result, Closure $next): Response;
}
