<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Payload;

use Tuzex\Responder\Http\HttpStatusCode;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\HttpConfig;

abstract class Data extends Result
{
    private iterable $iterableData;

    protected function __construct(iterable $iterableData, HttpConfig $httpConfig)
    {
        $this->iterableData = $iterableData;

        parent::__construct($httpConfig);
    }

    abstract public static function define(iterable $iterableData, int $statusCode = HttpStatusCode::OK): self;

    public function iterableData(): iterable
    {
        return $this->iterableData;
    }
}
