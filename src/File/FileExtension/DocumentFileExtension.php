<?php

declare(strict_types=1);

namespace Tuzex\Responder\File\FileExtension;

use Tuzex\Responder\File\FileExtension;

enum DocumentFileExtension: string implements FileExtension
{
    case CSV = 'csv';
    case HTML = 'html';
    case XHTML = 'xhtml';
    case JAR = 'jar';
    case JSON = 'json';
    case JSON_LD = 'jsonld';
    case PDF = 'pdf';
    case OTF = 'otf';
    case PPT = 'ppt';
    case PPTX = 'pptx';
    case TTF = 'ttf';
    case TXT = 'txt';
    case VSD = 'vsd';
    case WOFF = 'woff';
    case WOFF2 = 'woff2';
    case XLS = 'xls';
    case XLSX = 'xlsx';
    case XML = 'xml';

    public function value(): string
    {
        return sprintf('.%s', trim($this->value, '.'));
    }
}
