<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Http;

enum Disposition: string
{
    case ATTACHMENT = 'attachment';
    case INLINE = 'inline';
    case FORM_DATA = 'form-data';
}
