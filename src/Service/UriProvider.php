<?php

declare(strict_types=1);

namespace Tuzex\Responder\Service;

use Tuzex\Responder\Bridge\HttpFoundation\RequestAccessor;

final class UriProvider
{
    public function __construct(
        private RequestAccessor $requestAccessor
    ) {}

    public function provide(): string
    {
        $request = $this->requestAccessor->get();

        return $request->getUri();
    }
}
