<?php

declare(strict_types=1);

namespace Codea\SmartReply\Response\Resource\Text;

use Codea\SmartReply\Http\Charset;
use Codea\SmartReply\Http\Charset\UnicodeCharset;
use Codea\SmartReply\Http\HttpHeader\ContentTypeHttpHeader;
use Codea\SmartReply\Http\MimeType\TextMimeType;
use Codea\SmartReply\Http\StatusCode;
use Codea\SmartReply\Response\Resource;
use Codea\SmartReply\Response\Resource\Text;

final class HtmlText extends Resource implements Text
{
    public function __construct(
        public readonly string $content,
        StatusCode $statusCode = StatusCode::OK,
        Charset $charset = UnicodeCharset::UTF8,
    ) {
        parent::__construct($statusCode, new ContentTypeHttpHeader(TextMimeType::HTML, $charset));
    }

    public function content(): string
    {
        return $this->content;
    }
}
