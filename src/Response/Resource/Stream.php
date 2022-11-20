<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Response\Resource;

use Closure;

interface Stream
{
    public function callback(): Closure;
}
