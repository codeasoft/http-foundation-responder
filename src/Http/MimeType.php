<?php

declare(strict_types=1);

namespace Codea\Responder\Http;

interface MimeType
{
    public function value(): string;
}
