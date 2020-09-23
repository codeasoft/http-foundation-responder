<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Http;

use Tuzex\Symfony\Responder\Http\Header\Header;

final class Headers
{
    private array $headers = [];

    public function __construct(Header ...$headers)
    {
        foreach ($headers as $header) {
            $this->headers[$header->getName()] = $header;
        }
    }

    public function getHeaders(): array
    {
        return array_map(fn (Header $header): string => $header->getValue(), $this->headers);
    }

    public function unify(self $another): self
    {
        return new self(...array_values(array_merge($this->headers, $another->headers)));
    }
}
