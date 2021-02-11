<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http;

interface UriProvider
{
    public function provide(): string;
}
