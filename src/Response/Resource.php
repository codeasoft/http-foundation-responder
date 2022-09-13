<?php

declare(strict_types=1);

namespace Codea\Responder\Response;

use Codea\Responder\Http\HttpHeader;
use Codea\Responder\Http\StatusCode;

abstract class Resource
{
    private HttpConfig $httpConfig;

    public function __construct(StatusCode $statusCode, HttpHeader ...$httpHeaders)
    {
        $this->httpConfig = new HttpConfig($statusCode, ...$httpHeaders);
    }

    public function httpConfig(): HttpConfig
    {
        return $this->httpConfig;
    }

    public function addHttpHeader(HttpHeader ...$httpHeaders): void
    {
        $this->httpConfig = $this->httpConfig->extend(...$httpHeaders);
    }
}
