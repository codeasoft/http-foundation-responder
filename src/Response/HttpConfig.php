<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response;

use Tuzex\Responder\Http\HttpHeaders;
use Tuzex\Responder\Http\StatusCode;

final class HttpConfig
{
    public function __construct(
        private StatusCode $statusCode,
        private HttpHeaders $headers,
    ) {}

    public static function set(StatusCode $statusCode, array $headers = []): self
    {
        return new self($statusCode, new HttpHeaders(...$headers));
    }

    public function statusCode(): int
    {
        return $this->statusCode->value;
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
