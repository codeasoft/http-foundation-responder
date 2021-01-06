<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result;

interface Metadata
{
    public function getType(): string;

    public function getValue(): mixed;
}
