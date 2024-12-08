<?php

namespace Modules\Main\Enums;

enum PublishStatusEnum :string
{
    case Published ='published';
    case Draft ='drafted';
    case Postpone ='postpone';

    case redirect ='redirect';
}
