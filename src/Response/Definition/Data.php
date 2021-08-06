<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Definition;

use Tuzex\Responder\Http\HttpStatusCode;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\ResponseDefinition;

abstract class Data extends ResponseDefinition
{
    private iterable $iterable;

    protected function __construct(iterable $iterable, HttpConfig $httpConfig)
    {
        $this->iterable = $iterable;

        parent::__construct($httpConfig);
    }

    abstract public static function define(iterable $iterable, int $statusCode = HttpStatusCode::OK): self;

    public function iterable(): iterable
    {
        return $this->iterable;
    }
}
