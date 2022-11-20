<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Response;

final class FlashMessage
{
    public function __construct(
        public readonly string $type,
        public readonly string $message
    ) {
    }
}
