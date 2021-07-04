<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Payload;

use Assert\Assertion;
use Tuzex\Responder\Http\HttpStatusCode;
use Tuzex\Responder\Result\HttpConfig;

abstract class FileContent extends Content
{
    private string $name;

    protected function __construct(string $content, string $name, HttpConfig $httpConfig)
    {
        Assertion::endsWith($name, $this->extension());

        $this->name = $name;

        parent::__construct($content, $httpConfig);
    }

    abstract public static function download(string $content, string $name, int $statusCode = HttpStatusCode::OK): self;

    abstract public static function display(string $content, string $name, int $statusCode = HttpStatusCode::OK): self;

    public function name(): string
    {
        return $this->name;
    }

    abstract public function mimeType(): string;

    abstract protected function extension(): string;
}
