<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Payload;

use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\HttpConfig;

abstract class Data extends Result
{
    private iterable $data;

    public function __construct(iterable $data, HttpConfig $httpConfig)
    {
        $this->data = $data;

        parent::__construct($httpConfig);
    }

    abstract public static function send(iterable $data, int $statusCode = StatusCode::OK): self;

    public function getData(): iterable
    {
        return $this->data;
    }
}
