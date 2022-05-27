<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http\MimeType;

use Tuzex\Responder\Http\MimeType;

enum FontMimeType: string implements MimeType
{
    case TTF = 'font/ttf';
    case OTF = 'font/otf';
    case WOFF = 'font/woff';
    case WOFF2 = 'font/woff2';

    public function type(): string
    {
        return $this->value;
    }
}
