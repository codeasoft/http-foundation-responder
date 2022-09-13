<?php

declare(strict_types=1);

namespace Codea\Responder\Http;

interface HttpHeader
{
    public const CONTENT_TYPE = 'Content-Type';

    public const CONTENT_DISPOSITION = 'Content-Disposition';

    public const X_ACCEL_BUFFERING = 'X-Accel-Buffering';

    public function name(): string;

    public function value(): string;
}
