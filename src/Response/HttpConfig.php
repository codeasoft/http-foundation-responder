<?php

declare(strict_types=1);

namespace Codea\Responder\Response;

use Codea\Responder\Http\HttpHeader;
use Codea\Responder\Http\StatusCode;

final class HttpConfig
{
    private array $httpHeaders = [];

    public function __construct(
        private StatusCode $statusCode,
        HttpHeader ...$httpHeaders,
    ) {
        foreach ($httpHeaders as $httpHeader) {
            $this->httpHeaders[$httpHeader->name()] = $httpHeader;
        }
    }

    public function statusCode(): int
    {
        return $this->statusCode->value;
    }

    public function httpHeaders(): array
    {
        return array_map(fn (HttpHeader $httpHeader): string => $httpHeader->value(), $this->httpHeaders);
    }

    public function extend(HttpHeader ...$httpHeaders): self
    {
        $httpHeaders = array_merge(
            array_values($this->httpHeaders),
            $httpHeaders,
        );

        return new self($this->statusCode, ...$httpHeaders);
    }
}
