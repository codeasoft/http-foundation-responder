<?php

declare(strict_types=1);

namespace Tuzex\Responder\Service;

interface FlashMessagePublisher
{
    public function publish(string $type, string $message): void;
}
