<?php

declare(strict_types=1);

namespace Codea\SmartReply\Http;

interface UriProvider
{
    public function provide(): string;
}
