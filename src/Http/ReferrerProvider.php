<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Http;

interface ReferrerProvider
{
    public function provide(): string;
}
