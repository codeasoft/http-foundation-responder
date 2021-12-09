<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http\HttpHeader;

use Tuzex\Responder\Http\HttpHeader;

final class MultipartContentDisposition extends ContentDisposition implements HttpHeader
{
    public function __construct(
        private string $name,
        private string $filename = '',
    ) {
    }

    public function value(): string
    {
        return sprintf('form-data; name="%s"%s', $this->name, $this->filename());
    }

    private function filename(): string
    {
        return ! empty($this->filename) ? sprintf('; filename="%s"', $this->filename) : $this->filename;
    }
}
