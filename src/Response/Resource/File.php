<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource;

use Assert\Assertion;
use Tuzex\Responder\File\FileType;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\Resource;

abstract class File extends Resource
{
    public readonly string $path;
    public readonly string $name;

    protected function __construct(string $path, string $name, HttpConfig $httpConfig)
    {
        Assertion::endsWith($path, $this->fileType()->extension());
        Assertion::endsWith($name, $this->fileType()->extension());

        $this->path = $path;
        $this->name = $name;

        parent::__construct($httpConfig);
    }

    abstract public static function setForDownload(string $path, string $name): self;

    abstract public static function setForDisplay(string $path, string $name): self;

    abstract protected function fileType(): FileType;
}
