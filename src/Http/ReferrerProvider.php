<?php

declare(strict_types=1);

namespace Codea\Responder\Http;

interface ReferrerProvider
{
    public function provide(): string;
}
