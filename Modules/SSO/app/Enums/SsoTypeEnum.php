<?php

namespace Modules\SSO\Enums;

enum SsoTypeEnum :string
{
    case google = "google";
    case linkedin = "linkedin";

    case github = "github";
    case gitlab = "gitlab";
    case facebook = "facebook";
    case twitter = "twitter";
}
