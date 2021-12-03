<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http\HttpHeader;

use Tuzex\Responder\Http\Disposition;
use Tuzex\Responder\Http\HttpHeader;

final class ContentDisposition implements HttpHeader
{
    public function __construct(
        private Disposition $disposition,
        private string $filename,
        private string $field = '',
    ) {
    }

    public function name(): string
    {
        return 'Content-Disposition';
    }

    public function value(): string
    {
        return match($this->disposition) {
            Disposition::FORMDATA => sprintf('%s; name="%s" filename="%s"', $this->disposition->value, $this->field, $this->filename),
            default => sprintf('%s; filename="%s"', $this->disposition->value, $this->filename),
        };
    }
}
