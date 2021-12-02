<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http\HttpHeader\ContentType;

use Tuzex\Responder\Http\HttpHeader;
use Tuzex\Responder\Http\HttpHeader\ContentType;
use Tuzex\Responder\Http\MimeType\MultipartMimeType;

final class MultipartContentType extends ContentType implements HttpHeader
{
    private string $boundary;

    public function __construct(
        private MultipartMimeType $mimeType,
        string $boundary,
    ) {
        $this->boundary = trim($boundary);
    }

    public function value(): string
    {
        return sprintf('%s; boundary=%s', $this->mimeType->value(), $this->boundary);
    }
}
