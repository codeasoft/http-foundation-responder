<?php

declare(strict_types=1);

namespace Tuzex\Responder;

use Closure;
use Symfony\Component\HttpFoundation\Response;

interface ResponseFactory
{
    public function create(Result $result, Closure $next): Response;
}
