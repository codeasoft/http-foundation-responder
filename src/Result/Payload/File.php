<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Payload;

use Assert\Assertion;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\HttpConfig;

abstract class File extends Result
{
    private string $path;
    private string $name;

    public function __construct(string $path, string $name, HttpConfig $httpConfig)
    {
        Assertion::endsWith($path, $this->getSuffix());
        Assertion::endsWith($name, $this->getSuffix());

        $this->path = $path;
        $this->name = $name;

        parent::__construct($httpConfig);
    }

    abstract public static function display(string $path, string $name, int $statusCode): self;

    abstract public static function download(string $path, string $name, int $statusCode): self;

    public function getPath(): string
    {
        return $this->path;
    }

    public function getName(): string
    {
        return $this->name;
    }

    abstract protected function getSuffix(): string;
}
