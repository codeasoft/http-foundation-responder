<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource;

use Assert\Assertion;
use Tuzex\Responder\Response\HttpConfig;

abstract class FileContent extends Text
{
    public readonly string $name;

    protected function __construct(string $content, string $name, HttpConfig $httpConfig)
    {
        Assertion::endsWith($name, $this->extension());

        $this->name = $name;

        parent::__construct($content, $httpConfig);
    }

    abstract public static function setForDownload(string $content, string $name): self;

    abstract public static function setForDisplay(string $content, string $name): self;

    abstract public function mimeType(): string;

    abstract protected function extension(): string;
}
