<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result;

use Tuzex\Symfony\Responder\Metadata\Metadata;

final class MetadataSet
{
    private array $set = [];

    public function __construct(Metadata ...$metadata)
    {
        array_walk($metadata, function (Metadata $metadata): void {
            $this->set[$metadata->getType()] = $metadata;
        });
    }

    public function has(string $type): bool
    {
        return array_key_exists($type, $this->set);
    }

    public function get(string $type): ?Metadata
    {
        return $this->set[$type] ?? null;
    }

    public function push(Metadata ...$set): self
    {
        return new self(...array_values(array_merge($this->set, $set)));
    }
}
