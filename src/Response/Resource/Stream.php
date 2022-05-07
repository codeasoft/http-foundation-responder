<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource;

use Closure;

interface Stream
{
    public function callback(): Closure;
}
