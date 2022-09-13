<?php

declare(strict_types=1);

namespace Codea\Responder\Http\HttpHeader;

use Codea\Responder\Http\Charset;
use Codea\Responder\Http\HttpHeader;
use Codea\Responder\Http\MimeType\MultipartMimeType;

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
            $this->mimeType->value(),
            $this->boundary,
            $this->charset->value(),
        ]);
    }
}
