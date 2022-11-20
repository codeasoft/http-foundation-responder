<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Bridge\HttpFoundation\Request;

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
        return $this->requestStack->getCurrentRequest() ?? throw new RuntimeException('The latest Symfony request is missing.');
    }
}
