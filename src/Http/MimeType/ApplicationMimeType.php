<?php

declare(strict_types=1);

namespace Codea\SmartReply\Http\MimeType;

use Codea\SmartReply\Http\MimeType;

enum ApplicationMimeType: string implements MimeType
{
    case BIN = 'application/octet-stream';
    case DOC = 'application/msword';
    case DOCX = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
    case GZ = 'application/gzip';
    case FORM = 'application/x-www-form-urlencoded';
    case JAR = 'application/java-archive';
    case JSON = 'application/json';
    case JSON_LD = 'application/ld+json';
    case PDF = 'application/pdf';
    case PPT = 'application/vnd.ms-powerpoint';
    case PPTX = 'application/vnd.openxmlformats-officedocument.presentationml.presentation';
    case RAR = 'application/vnd.rar';
    case TAR = 'application/x-tar';
    case VSD = 'application/vnd.visio';
    case X7Z = 'application/x-7z-compressed';
    case XLS = 'application/vnd.ms-excel';
    case XLSX = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
    case XML = 'application/xml';
    case ZIP = 'application/zip';

    public function value(): string
    {
        return $this->value;
    }
}
