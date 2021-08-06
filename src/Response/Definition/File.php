<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Definition;

use Assert\Assertion;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\ResponseDefinition;

abstract class File extends ResponseDefinition
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

    abstract public static function defineForDownload(string $path, string $name): self;

    abstract public static function defineForDisplay(string $path, string $name): self;

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
