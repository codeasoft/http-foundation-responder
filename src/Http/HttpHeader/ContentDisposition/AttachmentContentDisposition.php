<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http\HttpHeader\ContentDisposition;

use Tuzex\Responder\Http\HttpHeader;
use Tuzex\Responder\Http\HttpHeader\ContentDisposition;

final class AttachmentContentDisposition extends ContentDisposition implements HttpHeader
{
    public function __construct(
        private string $filename
    ) {
    }

    public function value(): string
    {
        return sprintf('attachment; filename="%s"', $this->filename);
    }
}
