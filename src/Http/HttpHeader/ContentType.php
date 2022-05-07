<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http\HttpHeader;

use Tuzex\Responder\Http\Charset;
use Tuzex\Responder\Http\HttpHeader;
use Tuzex\Responder\Http\MimeType;

class ContentType implements HttpHeader
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
        return sprintf('%s; charset=%s', $this->mimeType->type(), $this->charset->value());
    }
}
