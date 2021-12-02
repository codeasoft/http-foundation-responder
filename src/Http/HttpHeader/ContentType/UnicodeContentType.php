<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http\HttpHeader\ContentType;

use Tuzex\Responder\Http\Charset\UnicodeCharset;
use Tuzex\Responder\Http\HttpHeader;
use Tuzex\Responder\Http\HttpHeader\ContentType;
use Tuzex\Responder\Http\MimeType;

final class UnicodeContentType extends ContentType implements HttpHeader
{
    public function __construct(
        private MimeType $mimeType,
        private UnicodeCharset $charset,
    ) {
    }

    public function value(): string
    {
        return sprintf('%s; charset=%s', $this->mimeType->value(), $this->charset->value());
    }
}
