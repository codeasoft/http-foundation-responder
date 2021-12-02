<?php

declare(strict_types=1);

namespace Tuzex\Responder\File\FileType;

use Tuzex\Responder\File\FileType;

enum DocumentFileType: string implements FileType
{
    case CSV = 'csv';
    case DOCX = 'docx';
    case HTML = 'html';
    case JSON = 'json';
    case PDF = 'pdf';
    case TXT = 'txt';
    case XML = 'xml';
    case XLSX = 'xlsx';

    public function extension(): string
    {
        return sprintf('.%s', $this->value);
    }
}
