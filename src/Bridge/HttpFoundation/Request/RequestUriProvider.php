<?php

declare(strict_types=1);

namespace Codea\Responder\Bridge\HttpFoundation\Request;

use Codea\Responder\Http\UriProvider;

final class RequestUriProvider implements UriProvider
{
    public function __construct(
        private RequestAccessor $requestAccessor
    ) {}

    public function provide(): string
    {
        return $this->requestAccessor->get()->getUri();
    }
}
