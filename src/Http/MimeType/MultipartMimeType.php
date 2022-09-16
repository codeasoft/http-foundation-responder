<?php

declare(strict_types=1);

namespace Codea\SmartReply\Http\MimeType;

use Codea\SmartReply\Http\MimeType;

enum MultipartMimeType: string implements MimeType
{
    case ALTERNATIVE = 'multipart/alternative';
    case FORM_DATA = 'multipart/form-data';
    case MIXED = 'multipart/mixed';
    case RELATED = 'multipart/related';

    public function value(): string
    {
        return $this->value;
    }
}
