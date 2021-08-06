<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Definition;

use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\ResponseDefinition;

abstract class Text extends ResponseDefinition
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
