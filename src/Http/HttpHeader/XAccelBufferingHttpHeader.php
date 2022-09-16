<?php

declare(strict_types=1);

namespace Codea\SmartReply\Http\HttpHeader;

use Codea\SmartReply\Http\HttpHeader;

enum XAccelBufferingHttpHeader:string implements HttpHeader
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
