<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource;

use Tuzex\Responder\File\FileFormat;
use Tuzex\Responder\Http\Charset;
use Tuzex\Responder\Http\Charset\UnicodeCharset;
use Tuzex\Responder\Http\HttpHeader\ContentTypeHttpHeader;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Response\Resource;
use Webmozart\Assert\Assert;

abstract class Template extends Resource
{
    public function __construct(
        public readonly string $name,
        public readonly array $parameters = [],
        StatusCode $statusCode = StatusCode::OK,
        Charset $charset = UnicodeCharset::UTF8
    ) {
        Assert::endsWith($this->name, $this->fileFormat()->extension());

        $httpHeaders = [
            new ContentTypeHttpHeader($this->mimeType(), $charset),
        ];

        parent::__construct($statusCode, ...$httpHeaders);
    }

    abstract protected function fileFormat(): FileFormat;

    abstract protected function mimeType(): MimeType;
}
