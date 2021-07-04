<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Payload;

use Tuzex\Responder\Http\HttpStatusCode;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\HttpConfig;

abstract class Data extends Result
{
    private iterable $iterable;

    protected function __construct(iterable $iterable, HttpConfig $httpConfig)
    {
        $this->iterable = $iterable;

        parent::__construct($httpConfig);
    }

    abstract public static function send(iterable $iterable, int $statusCode = HttpStatusCode::OK): self;

    public function iterable(): iterable
    {
        return $this->iterable;
    }
}
