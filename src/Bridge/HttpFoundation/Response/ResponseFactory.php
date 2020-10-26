<?php

declare(strict_types=1);

namespace Tuzex\Responder\Bridge\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Result\HttpConfig;

final class ResponseFactory
{
    public function create(string $content, HttpConfig $httpConfig): Response
    {
        return new Response($content, $httpConfig->getStatusCode(), $httpConfig->getHeaders());
    }
}
