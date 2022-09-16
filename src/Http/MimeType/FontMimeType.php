<?php

declare(strict_types=1);

namespace Codea\SmartReply\Http\MimeType;

use Codea\SmartReply\Http\MimeType;

enum FontMimeType: string implements MimeType
{
    case TTF = 'font/ttf';
    case OTF = 'font/otf';
    case WOFF = 'font/woff';
    case WOFF2 = 'font/woff2';

    public function value(): string
    {
        return $this->value;
    }
}
