<?php

declare(strict_types=1);

namespace Tuzex\Responder\File\FileType;

use Tuzex\Responder\File\FileType;

enum TemplateFileType: string implements FileType
{
    case LATTE = 'latte';
    case TWIG = 'twig';

    public function extension(): string
    {
        return sprintf('.%s', $this->value);
    }
}
