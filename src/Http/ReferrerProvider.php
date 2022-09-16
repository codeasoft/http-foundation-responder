<?php

declare(strict_types=1);

namespace Codea\SmartReply\Http;

interface ReferrerProvider
{
    public function provide(): string;
}
