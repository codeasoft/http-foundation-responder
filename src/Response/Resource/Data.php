<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource;

use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\Resource;

abstract class Data extends Resource
{
    protected function __construct(
        public readonly iterable $list,
        HttpConfig $httpConfig
    )
    {
        parent::__construct($httpConfig);
    }

    abstract public static function set(iterable $list, StatusCode $statusCode = StatusCode::OK): self;
}
