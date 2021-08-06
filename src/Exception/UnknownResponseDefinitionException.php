<?php

declare(strict_types=1);

namespace Tuzex\Responder\Exception;

use RuntimeException;
use Tuzex\Responder\Response\ResponseDefinition;

final class UnknownResponseDefinitionException extends RuntimeException
{
    public function __construct(ResponseDefinition $responseDefinition)
    {
        parent::__construct(
            sprintf('Response definition "%s" does not accept any response factory.', $responseDefinition::class)
        );
    }
}
