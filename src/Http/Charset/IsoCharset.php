<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http\Charset;

use Tuzex\Responder\Http\Charset;

enum IsoCharset: string implements Charset
{
    case ISO_8859_1 = 'ISO-8859-1';
    case ISO_8859_8 = 'ISO-8859-8';
    case ISO_8859_9 = 'ISO-8859-9';

    public function value(): string
    {
        return $this->value;
    }
}
