<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http\HttpHeader;

use Tuzex\Responder\Http\Charset;
use Tuzex\Responder\Http\HttpHeader;
use Tuzex\Responder\Http\MimeType;

class ContentType implements HttpHeader
{
    public function __construct(
        private MimeType $mimeType,
        private Charset $charset,
    ) {
    }

    public function name(): string
    {
        return 'Content-Type';
    }

    public function value(): string
    {
        return sprintf('%s; charset=%s', $this->mimeType->value(), $this->charset->value());
    }
}