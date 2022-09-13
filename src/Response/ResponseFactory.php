<?php

declare(strict_types=1);

namespace Codea\Responder\Response;

use Closure;
use Symfony\Component\HttpFoundation\Response;

interface ResponseFactory
{
    public function create(Resource $resource, Closure $nextResponseFactory): Response;
}
