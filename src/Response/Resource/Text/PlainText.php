<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Response\Resource\Text;

use Termyn\SmartReply\Http\Charset;
use Termyn\SmartReply\Http\Charset\UnicodeCharset;
use Termyn\SmartReply\Http\HttpHeader\ContentTypeHttpHeader;
use Termyn\SmartReply\Http\MimeType\TextMimeType;
use Termyn\SmartReply\Http\StatusCode;
use Termyn\SmartReply\Response\Resource;
use Termyn\SmartReply\Response\Resource\Text;

final class PlainText extends Resource implements Text
{
    public function __construct(
        public readonly string $content,
        StatusCode $statusCode = StatusCode::OK,
        Charset $charset = UnicodeCharset::UTF8,
    ) {
        parent::__construct($statusCode, new ContentTypeHttpHeader(TextMimeType::TXT, $charset));
    }

    public function content(): string
    {
        return $this->content;
    }
}
