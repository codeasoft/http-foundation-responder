<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Payload;

use Tuzex\Responder\Http\Header\ContentType;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\HttpConfig;

final class Json extends Result
{
    private iterable $data;

    public function __construct(iterable $data, HttpConfig $httpConfig)
    {
        $this->data = $data;

        parent::__construct($httpConfig);
    }

    public static function send(iterable $data, int $statusCode = StatusCode::OK): self
    {
        return new self($data, HttpConfig::set($statusCode, [
            new ContentType(MimeType::JSON),
        ]));
    }

    public function getData(): iterable
    {
        return $this->data;
    }
}
