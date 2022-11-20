<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Response\Resource;

use Termyn\SmartReply\File\FileExtension;
use Termyn\SmartReply\Http\Charset;
use Termyn\SmartReply\Http\Charset\UnicodeCharset;
use Termyn\SmartReply\Http\HttpHeader\ContentTypeHttpHeader;
use Termyn\SmartReply\Http\MimeType;
use Termyn\SmartReply\Http\StatusCode;
use Termyn\SmartReply\Response\Resource;
use Webmozart\Assert\Assert;

abstract class Template extends Resource
{
    public function __construct(
        public readonly string $name,
        public readonly array $parameters = [],
        StatusCode $statusCode = StatusCode::OK,
        Charset $charset = UnicodeCharset::UTF8
    ) {
        Assert::endsWith(
            $this->name,
            $this->fileExtension()->value()
        );

        $httpHeaders = [
            new ContentTypeHttpHeader($this->mimeType(), $charset),
        ];

        parent::__construct($statusCode, ...$httpHeaders);
    }

    abstract protected function fileExtension(): FileExtension;

    abstract protected function mimeType(): MimeType;
}
