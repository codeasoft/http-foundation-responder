<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result;

use Tuzex\Responder\Http\HttpHeaders;
use Tuzex\Responder\Http\HttpStatusCode;

final class HttpConfig
{
    public function __construct(
        private HttpStatusCode $statusCode,
        private HttpHeaders $headers,
    ) {}

    public static function set(int $statusCode, array $headers = []): self
    {
        return new self(
            new HttpStatusCode($statusCode),
            new HttpHeaders(...$headers)
        );
    }

    public function statusCode(): int
    {
        return $this->statusCode->getCode();
    }

    public function headers(): array
    {
        return $this->headers->list();
    }

    public function setHeaders(HttpHeaders $headers): self
    {
        return new self($this->statusCode, $this->headers->push($headers));
    }
}
