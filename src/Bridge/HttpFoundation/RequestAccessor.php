<?php

declare(strict_types=1);

namespace Tuzex\Responder\Bridge\HttpFoundation;

use RuntimeException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class RequestAccessor
{
    public function __construct(
        private RequestStack $requestStack,
    ) {}

    public function get(): Request
    {
        $request = $this->requestStack->getCurrentRequest();
        if (!$request) {
            throw new RuntimeException('The latest Symfony request is missing.');
        }

        return $request;
    }
}
