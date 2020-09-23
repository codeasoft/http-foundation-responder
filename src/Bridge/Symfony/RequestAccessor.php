<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Bridge\Symfony;

use RuntimeException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class RequestAccessor
{
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function get(): Request
    {
        $request = $this->requestStack->getCurrentRequest();
        if (!$request) {
            throw new RuntimeException('The current / latest request is missing.');
        }

        return $request;
    }
}
