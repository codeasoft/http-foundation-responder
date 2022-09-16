<?php

declare(strict_types=1);

namespace Codea\SmartReply\Http\HttpHeader;

use Codea\SmartReply\Http\Charset;
use Codea\SmartReply\Http\HttpHeader;
use Codea\SmartReply\Http\MimeType;

class ContentTypeHttpHeader implements HttpHeader
{
    public function __construct(
        protected readonly MimeType $mimeType,
        protected readonly Charset $charset,
    ) {
    }

    public function name(): string
    {
        return HttpHeader::CONTENT_TYPE;
    }

    public function value(): string
    {
        return sprintf('%s; charset=%s', $this->mimeType->value(), $this->charset->value());
    }
}
