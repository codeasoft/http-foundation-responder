<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http;

enum Disposition: string
{
    case ATTACHMENT = 'attachment';
    case INLINE = 'inline';
    case FORMDATA = 'form-data';
}