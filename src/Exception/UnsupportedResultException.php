<?php

declare(strict_types=1);

namespace Tuzex\Responder\Exception;

use RuntimeException;
use Tuzex\Responder\Result;

final class UnsupportedResultException extends RuntimeException
{
    public function __construct(Result $result, string $factoryClass)
    {
        parent::__construct(
            sprintf('Result "%s" is not supported by the factory "%s".', $result::class, $factoryClass)
        );
    }
}
