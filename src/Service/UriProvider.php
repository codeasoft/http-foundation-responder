<?php

declare(strict_types=1);

namespace Tuzex\Responder\Service;

use Tuzex\Responder\Bridge\HttpFoundation\RequestAccessor;

final class UriProvider
{
    private RequestAccessor $requestAccessor;

    public function __construct(RequestAccessor $requestAccessor)
    {
        $this->requestAccessor = $requestAccessor;
    }

    public function provide(): string
    {
        $request = $this->requestAccessor->get();

        return $request->getUri();
    }
}
