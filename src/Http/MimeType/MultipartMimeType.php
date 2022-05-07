<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http\MimeType;

use Tuzex\Responder\Http\MimeType;

enum MultipartMimeType: string implements MimeType
{
    case ALTERNATIVE = 'multipart/alternative';
    case FORMDATA = 'multipart/form-data';
    case MIXED = 'multipart/mixed';
    case RELATED = 'multipart/related';

    public function type(): string
    {
        return $this->value;
    }
}
