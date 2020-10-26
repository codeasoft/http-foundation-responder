<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http;

interface Header
{
    public function getName(): string;

    public function getValue(): string;

    public function getField(): string;
}
