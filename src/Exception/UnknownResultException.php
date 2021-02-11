<?php

declare(strict_types=1);

namespace Tuzex\Responder\Exception;

use RuntimeException;
use Tuzex\Responder\Result;

final class UnknownResultException extends RuntimeException
{
    public function __construct(Result $result)
    {
        parent::__construct(sprintf('Result "%s" does not accept any response factory.', $result::class));
    }
}
