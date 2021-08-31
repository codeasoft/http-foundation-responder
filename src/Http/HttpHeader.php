<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http;

interface HttpHeader
{
    public function name(): string;

    public function value(): string;

    public function field(): string;
}
