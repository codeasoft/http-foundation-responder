<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http\HttpHeader;

use Tuzex\Responder\Http\Charset;
use Tuzex\Responder\Http\HttpHeader;
use Tuzex\Responder\Http\MimeType\MultipartMimeType;

final class MultipartContentTypeHttpHeader extends ContentTypeHttpHeader implements HttpHeader
{
    private readonly string $boundary;

    public function __construct(
        MultipartMimeType $mimeType,
        Charset $charset,
        string $boundary,
    ) {
        parent::__construct($mimeType, $charset);

        $this->boundary = trim($boundary);
    }

    public function value(): string
    {
        return vsprintf('%s; boundary="%s"; charset=%s', [
            $this->mimeType->type(),
            $this->boundary,
            $this->charset->value(),
        ]);
    }
}
