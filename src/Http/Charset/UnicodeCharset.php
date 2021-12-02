<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http\Charset;

use Tuzex\Responder\Http\Charset;

enum UnicodeCharset: string implements Charset
{
    case UTF8 = 'UTF-8';
    case UTF16 = 'UTF-16';

    public function value(): string
    {
        return $this->value;
    }
}
