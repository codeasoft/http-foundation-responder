<?php

declare(strict_types=1);

namespace Codea\Responder\Http\MimeType;

use Codea\Responder\Http\MimeType;

enum TextMimeType: string implements MimeType
{
    case CSS = 'text/css';
    case CSV = 'text/csv';
    case HTML = 'text/html';
    case ICS = 'text/calendar';
    case JS = 'text/javascript';
    case TXT = 'text/plain';

    public function value(): string
    {
        return $this->value;
    }
}
