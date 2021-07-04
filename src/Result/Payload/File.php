<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Payload;

use Assert\Assertion;
use Tuzex\Responder\Http\HttpStatusCode;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\HttpConfig;

abstract class File extends Result
{
    private string $path;
    private string $name;

    protected function __construct(string $path, string $name, HttpConfig $httpConfig)
    {
        Assertion::endsWith($path, $this->extension());
        Assertion::endsWith($name, $this->extension());

        $this->path = $path;
        $this->name = $name;

        parent::__construct($httpConfig);
    }

    abstract public static function download(string $path, string $name, int $statusCode = HttpStatusCode::OK): self;

    abstract public static function display(string $path, string $name, int $statusCode = HttpStatusCode::OK): self;

    public function path(): string
    {
        return $this->path;
    }

    public function name(): string
    {
        return $this->name;
    }

    abstract public function mimeType(): string;

    abstract protected function extension(): string;
}
