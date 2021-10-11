<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource;

use Tuzex\Responder\Http\HttpStatusCode;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\ResponseResource;

abstract class Data extends ResponseResource
{
    protected function __construct(
        private iterable $payload,
        HttpConfig $httpConfig
    )
    {
        parent::__construct($httpConfig);
    }

    abstract public static function set(iterable $data, int $statusCode = HttpStatusCode::OK): self;

    public function payload(): iterable
    {
        return $this->payload;
    }
}
