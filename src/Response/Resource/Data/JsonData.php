<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\Data;

use Tuzex\Responder\Http\Charset;
use Tuzex\Responder\Http\Charset\UnicodeCharset;
use Tuzex\Responder\Http\HttpHeader\ContentTypeHttpHeader;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Response\Resource;
use Tuzex\Responder\Response\Resource\Data;

final class JsonData extends Resource implements Data
{
    public function __construct(
        public readonly iterable $datalist,
        StatusCode $statusCode = StatusCode::OK,
        Charset $charset = UnicodeCharset::UTF8,
    ) {
        parent::__construct(
            $statusCode,
            new ContentTypeHttpHeader(MimeType::JSON, $charset)
        );
    }

    public function datalist(): iterable
    {
        return $this->datalist;
    }
}
