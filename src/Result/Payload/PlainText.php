<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Result\Payload;

use Tuzex\Symfony\Responder\Http\Header\ContentType;
use Tuzex\Symfony\Responder\Http\MimeType;
use Tuzex\Symfony\Responder\Http\StatusCode;
use Tuzex\Symfony\Responder\Result\HttpConfigs;
use Tuzex\Symfony\Responder\Result\Result;

final class PlainText extends Result
{
    private string $content;

    public function __construct(string $content, HttpConfigs $httpConfigs)
    {
        $this->content = $content;

        parent::__construct($httpConfigs);
    }

    public static function init(string $content, int $statusCode = StatusCode::OK): self
    {
        return new self($content, HttpConfigs::set($statusCode, [
            new ContentType(MimeType::TEXT),
        ]));
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
