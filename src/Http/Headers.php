<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http;

final class Headers
{
    private array $headers = [];

    public function __construct(Header ...$headers)
    {
        foreach ($headers as $header) {
            $this->headers[$header->getName()] = $header;
        }
    }

    public function all(): array
    {
        return array_map(fn (Header $header): string => $header->getValue(), $this->headers);
    }

    public function unify(self $another): self
    {
        return new self(...array_merge(
            array_values($this->headers),
            array_values($another->headers)
        ));
    }
}
