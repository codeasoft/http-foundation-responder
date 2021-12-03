<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource;

interface Text
{
    public function content(): string;
}
