<?php

declare(strict_types=1);

namespace Codea\Responder\Http;

interface UriProvider
{
    public function provide(): string;
}
