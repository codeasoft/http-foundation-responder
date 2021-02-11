<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http;

interface ReferrerProvider
{
    public function provide(): string;
}
