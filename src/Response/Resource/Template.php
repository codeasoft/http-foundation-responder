<?php

declare(strict_types=1);

namespace Codea\Responder\Response\Resource;

use Codea\Responder\File\FileExtension;
use Codea\Responder\Http\Charset;
use Codea\Responder\Http\Charset\UnicodeCharset;
use Codea\Responder\Http\HttpHeader\ContentTypeHttpHeader;
use Codea\Responder\Http\MimeType;
use Codea\Responder\Http\StatusCode;
use Codea\Responder\Response\Resource;
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
