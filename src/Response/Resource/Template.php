<?php

declare(strict_types=1);

namespace Codea\SmartReply\Response\Resource;

use Codea\SmartReply\File\FileExtension;
use Codea\SmartReply\Http\Charset;
use Codea\SmartReply\Http\Charset\UnicodeCharset;
use Codea\SmartReply\Http\HttpHeader\ContentTypeHttpHeader;
use Codea\SmartReply\Http\MimeType;
use Codea\SmartReply\Http\StatusCode;
use Codea\SmartReply\Response\Resource;
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
