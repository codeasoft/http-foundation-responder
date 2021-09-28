<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response;

use Closure;
use Symfony\Component\HttpFoundation\Response;

interface ResponseFactory
{
    public function create(ResponseResource $responseResource, Closure $nextResponseFactory): Response;
}
