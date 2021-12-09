<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http\HttpHeader;

use Tuzex\Responder\Http\Disposition;
use Tuzex\Responder\Http\HttpHeader;

class ContentDisposition implements HttpHeader
{
    public function __construct(
        private Disposition $disposition,
        private string $filename,
    ) {
    }

    public function name(): string
    {
        return 'Content-Disposition';
    }

    public function value(): string
    {
        return sprintf('%s; filename="%s"', $this->disposition->value, $this->filename);
    }
}
