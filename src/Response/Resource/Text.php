<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Response\Resource;

interface Text
{
    public function content(): string;
}
