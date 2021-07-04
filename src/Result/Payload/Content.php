<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Payload;

use Tuzex\Responder\Result;
use Tuzex\Responder\Result\HttpConfig;

abstract class Content extends Result
{
    private string $body;

    protected function __construct(string $body, HttpConfig $httpConfig)
    {
        $this->body = $body;

        parent::__construct($httpConfig);
    }

    public function body(): string
    {
        return $this->body;
    }
}
