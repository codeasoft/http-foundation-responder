<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Exception;

use RuntimeException;
use Tuzex\Symfony\Responder\Result\Result;

final class UnsupportedResultException extends RuntimeException
{
    public function __construct(Result $result, string $factoryClass)
    {
        /*
         * @todo refactor PHP 8 $result::class
         */
        parent::__construct(
            sprintf('Result "%s" is not supported by the factory "%s".', get_class($result), $factoryClass)
        );
    }
}
