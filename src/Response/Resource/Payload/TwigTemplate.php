<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\Payload;

use Tuzex\Responder\File\FileInfo\TwigFileInfo;
use Tuzex\Responder\Http\Charset;
use Tuzex\Responder\Http\Charset\UnicodeCharset;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Response\Resource\Template;

final class TwigTemplate extends Template
{
    public function __construct(
        string $filepath,
        array $parameters = [],
        StatusCode $statusCode = StatusCode::OK,
        Charset $charset = UnicodeCharset::UTF8,
    ) {
        parent::__construct(new TwigFileInfo($filepath), $parameters, $statusCode, $charset);
    }
}
