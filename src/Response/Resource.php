<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response;

use Tuzex\Responder\Http\HttpHeader;
use Tuzex\Responder\Http\HttpHeaders;

abstract class Resource
{
    protected function __construct(
        private HttpConfig $httpConfig
    ) {
    }

    public function httpConfig(): HttpConfig
    {
        return $this->httpConfig;
    }

    public function addHttpHeader(HttpHeader ...$headers): void
    {
        $this->httpConfig = $this->httpConfig->setHeaders(new HttpHeaders(...$headers));
    }
}
