<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Http\MimeType;

use Termyn\SmartReply\Http\MimeType;

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
