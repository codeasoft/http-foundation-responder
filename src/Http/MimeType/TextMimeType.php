<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http\MimeType;

use Tuzex\Responder\Http\MimeType;

enum TextMimeType: string implements MimeType
{
    case PLAIN = 'text/plain';
    case HTML = 'text/html';

    public function type(): string
    {
        return $this->value;
    }
}
