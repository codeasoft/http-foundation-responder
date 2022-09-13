<?php

declare(strict_types=1);

namespace Codea\Responder\Http\HttpHeader;

use Codea\Responder\Http\Disposition;
use Codea\Responder\Http\HttpHeader;

final class MultipartContentDispositionHttpHeader extends ContentDispositionHttpHeader implements HttpHeader
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
