<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource;

use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\ResponseResource;

abstract class Text extends ResponseResource
{
    protected function __construct(
        private string $body,
        HttpConfig $httpConfig
    )
    {
        parent::__construct($httpConfig);
    }

    public function body(): string
    {
        return $this->body;
    }
}
