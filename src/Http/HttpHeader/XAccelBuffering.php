<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http\HttpHeader;

use Tuzex\Responder\Http\HttpHeader;

enum XAccelBuffering:string implements HttpHeader
{
    case YES = 'yes';
    case NO = 'no';

    public function name(): string
    {
        return HttpHeader::X_ACCEL_BUFFERING;
    }

    public function value(): string
    {
        return $this->value;
    }
}
