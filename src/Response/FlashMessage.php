<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response;

final class FlashMessage
{
    public function __construct(
        private string $type,
        private string $message
    ) {}

    public function type(): string
    {
        return $this->type;
    }

    public function message(): string
    {
        return $this->message;
    }
}
