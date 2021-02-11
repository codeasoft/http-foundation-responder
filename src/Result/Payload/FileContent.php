<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Payload;

use Assert\Assertion;
use Tuzex\Responder\Http\HttpStatusCode;
use Tuzex\Responder\Result\HttpConfig;

abstract class FileContent extends Content
{
    private string $fileName;

    protected function __construct(string $fileContent, string $fileName, HttpConfig $httpConfig)
    {
        Assertion::endsWith($fileName, $this->fileExtension());

        $this->fileName = $fileName;

        parent::__construct($fileContent, $httpConfig);
    }

    abstract public static function download(string $filePath, string $fileName, int $statusCode = HttpStatusCode::OK): self;

    abstract public static function display(string $filePath, string $fileName, int $statusCode = HttpStatusCode::OK): self;

    public function fileContent(): string
    {
        return $this->textBody();
    }

    public function fileName(): string
    {
        return $this->fileName;
    }

    abstract public function fileMimeType(): string;

    abstract protected function fileExtension(): string;
}
