<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Http;

interface UriProvider
{
    public function provide(): string;
}
