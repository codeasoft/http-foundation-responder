<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http;

interface HttpHeader
{
    public function getName(): string;

    public function getValue(): string;

    public function getField(): string;
}
