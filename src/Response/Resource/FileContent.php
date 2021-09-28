<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource;

use Assert\Assertion;
use Tuzex\Responder\Response\HttpConfig;

abstract class FileContent extends Text
{
    private string $name;

    protected function __construct(string $content, string $name, HttpConfig $httpConfig)
    {
        Assertion::endsWith($name, $this->extension());

        $this->name = $name;

        parent::__construct($content, $httpConfig);
    }

    abstract public static function defineForDownload(string $content, string $name): self;

    abstract public static function defineForDisplay(string $content, string $name): self;

    public function name(): string
    {
        return $this->name;
    }

    abstract public function mimeType(): string;

    abstract protected function extension(): string;
}
