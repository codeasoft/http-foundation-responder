<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Payload;

use Tuzex\Responder\Http\Header\ContentType;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\HttpConfig;

class Text extends Result
{
    private string $content;

    public function __construct(string $content, HttpConfig $httpConfig)
    {
        $this->content = $content;

        parent::__construct($httpConfig);
    }

    public static function send(string $content, int $statusCode = StatusCode::OK): self
    {
        return new self($content, HttpConfig::set($statusCode, [
            new ContentType(MimeType::TEXT),
        ]));
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
