<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource;

use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\Resource;

abstract class Text extends Resource
{
    protected function __construct(
        private string $payload,
        HttpConfig $httpConfig
    )
    {
        parent::__construct($httpConfig);
    }

    public function payload(): string
    {
        return $this->payload;
    }
}
