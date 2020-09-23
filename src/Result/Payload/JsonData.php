<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Result\Payload;

use Tuzex\Symfony\Responder\Http\Header\ContentType;
use Tuzex\Symfony\Responder\Http\MimeType;
use Tuzex\Symfony\Responder\Http\StatusCode;
use Tuzex\Symfony\Responder\Result\HttpConfigs;
use Tuzex\Symfony\Responder\Result\Result;

final class JsonData extends Result
{
    private iterable $data;

    public function __construct(iterable $data, HttpConfigs $httpConfigs)
    {
        $this->data = $data;

        parent::__construct($httpConfigs);
    }

    public static function init(iterable $data, int $statusCode = StatusCode::OK): self
    {
        return new self($data, HttpConfigs::set($statusCode, [
            new ContentType(MimeType::JSON),
        ]));
    }

    public function getData(): iterable
    {
        return $this->data;
    }
}
