<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource;

use Assert\Assertion;
use Tuzex\Responder\File\FileType;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\Resource;

abstract class Template extends Resource
{
    public readonly string $name;
    public readonly array $parameters;

    protected function __construct(string $name, array $parameters, HttpConfig $httpConfig)
    {
        Assertion::endsWith($name, $this->fileType()->extension());

        $this->name = $name;
        $this->parameters = $parameters;

        parent::__construct($httpConfig);
    }

    abstract public static function set(string $name, array $parameters = [], StatusCode $statusCode = StatusCode::OK): self;

    abstract protected function fileType(): FileType;
}
