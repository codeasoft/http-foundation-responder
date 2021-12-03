<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource;

use Tuzex\Responder\File\FileInfo;
use Tuzex\Responder\Http\Charset;
use Tuzex\Responder\Http\HttpHeader\ContentType;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Response\Resource;

abstract class Template extends Resource
{
    public readonly string $name;
    public readonly array $parameters;

    public function __construct(
        FileInfo $fileInfo,
        array $parameters,
        StatusCode $statusCode,
        Charset $charset
    ) {
        $this->name = $fileInfo->name;
        $this->parameters = $parameters;

        parent::__construct($statusCode, new ContentType($fileInfo->mime(), $charset));
    }
}
