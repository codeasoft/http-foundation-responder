<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Result;

use Tuzex\Symfony\Responder\Http\Headers;
use Tuzex\Symfony\Responder\Http\StatusCode;

final class HttpConfigs
{
    private StatusCode $statusCode;
    private Headers $headers;

    public function __construct(StatusCode $statusCode, Headers $headers)
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    public static function set(int $statusCode, array $headers = []): self
    {
        return new self(
            new StatusCode($statusCode),
            new Headers(...$headers)
        );
    }

    public function getStatusCode(): int
    {
        return $this->statusCode->getCode();
    }

    public function getHeaders(): array
    {
        return $this->headers->getHeaders();
    }

    public function joinHeaders(Headers $headers): self
    {
        return new self($this->statusCode, $this->headers->unify($headers));
    }
}
