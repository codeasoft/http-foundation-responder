<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Payload;

use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\HttpConfig;

abstract class Text extends Result
{
    private string $content;

    public function __construct(string $content, HttpConfig $httpConfig)
    {
        $this->content = $content;

        parent::__construct($httpConfig);
    }

    abstract public static function send(string $content, int $statusCode = StatusCode::OK): self;

    public function getContent(): string
    {
        return $this->content;
    }
}
