<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Bridge\HttpFoundation\Request;

use Termyn\SmartReply\Http\UriProvider;

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
