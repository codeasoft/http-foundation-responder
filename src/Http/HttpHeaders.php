<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http;

final class HttpHeaders
{
    private array $headers = [];

    public function __construct(HttpHeader ...$headers)
    {
        foreach ($headers as $header) {
            $this->headers[$header->getName()] = $header;
        }
    }

    public function list(): array
    {
        return array_map(fn (HttpHeader $header): string => $header->getValue(), $this->headers);
    }

    public function push(self $another): self
    {
        return new self(...array_merge(
            array_values($another->headers),
            array_values($this->headers),
        ));
    }
}
