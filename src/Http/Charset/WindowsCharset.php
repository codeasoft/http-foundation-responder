<?php

declare(strict_types=1);

namespace Codea\Responder\Http\Charset;

use Codea\Responder\Http\Charset;

enum WindowsCharset: string implements Charset
{
    case Windows_1251 = 'Windows-1251';
    case Windows_1252 = 'Windows-1252';
    case Windows_1254 = 'Windows-1254';

    public function value(): string
    {
        return $this->value;
    }
}
