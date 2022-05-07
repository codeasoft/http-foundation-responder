<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http\MimeType;

use Tuzex\Responder\Http\MimeType;

enum ApplicationMimeType: string implements MimeType
{
    case FORM = 'application/x-www-form-urlencoded';
    case JSON = 'application/json';
    case PDF = 'application/pdf';
    case XML = 'application/xml';
    case ZIP = 'application/zip';

    public function type(): string
    {
        return $this->value;
    }
}
