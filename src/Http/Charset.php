<?php

declare(strict_types=1);

namespace Codea\Responder\Http;

interface Charset
{
    public function value(): string;
}
