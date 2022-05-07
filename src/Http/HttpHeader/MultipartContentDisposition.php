<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http\HttpHeader;

use Tuzex\Responder\Http\Disposition;
use Tuzex\Responder\Http\HttpHeader;

final class MultipartContentDisposition extends ContentDisposition implements HttpHeader
{
    private readonly string $name;

    public function __construct(
        string $name,
        string $filename = ''
    ) {
        parent::__construct(Disposition::FORM_DATA, $filename);
        $this->name = $name;
    }

    public function value(): string
    {
        return vsprintf('%s; name="%s"%s', [
            $this->disposition->value,
            $this->name,
            $this->filename(),
        ]);
    }
}
