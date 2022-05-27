<?php

declare(strict_types=1);

namespace Tuzex\Responder\File\FileExtension;

use Tuzex\Responder\File\FileExtension;

enum TemplateFileExtension: string implements FileExtension
{
    case TWIG = 'twig';
    case LATTE = 'latte';
    case PHP = 'php';
    case BLADE = 'blade.php';

    public function value(): string
    {
        return sprintf('.%s', trim($this->value, '.'));
    }
}
