<?php

return [

    /*
  |--------------------------------------------------------------------------
  | Validation Language Lines
  |--------------------------------------------------------------------------
  |
  | The following language lines contain the default error messages used by
  | the validator class. Some of these rules have multiple versions such
  | as the size rules. Feel free to tweak each of these messages here.
  |
  */

    'accepted' => 'قسمت :attribute باید پذیرفته‌شود.',
    'accepted_if' => 'وقتی :other :value باشد، فیلد :attribute باید پذیرفته‌شود.',
    'active_url' => 'فیلد :attribute باید یک URL معتبر باشد.',
    'after' => 'فیلد :attribute باید تاریخی بعد از :date باشد.',
    'after_or_equal' => 'فیلد :attribute باید تاریخ بعد یا برابر با :date باشد.',
    'alpha' => 'فیلد :attribute فقط باید حاوی حروف باشد.',
    'alpha_dash' => 'فیلد :attribute فقط باید شامل حروف، اعداد، خط تیره و زیرخط باشد.',
    'alpha_num' => 'مقدار :attribute باید تنها اعداد و حروف باشد',
    'array' => 'مقدار :attribute باید آرایه باشد',
    'ascii' => 'فیلد :attribute باید فقط شامل کاراکترها و نمادهای الفبایی تک بایتی باشد.',
    'before' => 'مقدار :attribute باید قبل از :date باشد',
    'before_or_equal' => 'فیلد :attribute باید تاریخ قبل یا برابر با :date باشد.',
    'between' => [
        'array' => 'فیلد :attribute باید بین :min و:max باشد.',
        'file' => 'فیلد :attribute باید بین :min و:max کیلوبایت باشد.',
        'numeric' => 'فیلد :attribute باید بین :min و:max باشد.',
        'string' => 'فیلد :attribute باید بین :min و :max کاراکتر باشد.',
    ],
    'boolean' => 'فیلد :attribute باید درست (true) یا نادرست (false) باشد.',
    'can' => 'فیلد :attribute حاوی مقدار غیرمجاز است.',
    'confirmed' => 'تأیید فیلد :attribute مطابقت ندارد.',
    'current_password' => 'رمز عبور نادرست است.',
    'date' => 'فیلد :attribute باید یک تاریخ معتبر باشد.',
    'date_equals' => 'فیلد :attribute باید تاریخی برابر با :date باشد.',
    'date_format' => 'فیلد :attribute باید با قالب :format مطابقت داشته‌باشد.',
    'decimal' => 'فیلد :attribute باید دارای اعشار اعشاری باشد.',
    'declined' => 'فیلد :attribute باید رد شود.',
    'declined_if' => 'وقتی :other :value باشد، فیلد :attribute باید رد شود.',
    'different' => 'فیلد :attribute و :other باید متفاوت باشند.',
    'digits' => 'فیلد :attribute باید ارقام :digits باشد.',
    'digits_between' => 'فیلد :attribute باید بین رقم :min و :max باشد.',
    'dimensions' => 'فیلد :attribute دارای ابعاد تصویر نامعتبر است.',
    'distinct' => 'فیلد :attribute دارای یک مقدار تکراری است.',
    'doesnt_end_with' => 'فیلد :attribute نباید به یکی از موارد زیر ختم شود: :values.',
    'doesnt_start_with' => 'فیلد :attribute نباید با یکی از موارد زیر شروع شود: :values.',
    'email' => 'فیلد :attribute باید یک آدرس ایمیل معتبر باشد.',
    'ends_with' => 'فیلد :attribute باید به یکی از موارد زیر ختم شود: :values.',
    'enum' => ':attribute انتخاب شده نامعتبر است.',
    'exists' => ':attribute انتخاب شده نامعتبر است.',
    'file' => 'فیلد :attribute باید یک فایل باشد.',
    'filled' => 'فیلد :attribute باید دارای مقدار باشد.',
    'gt' => [
        'array' => 'فیلد :attribute باید مقداری بیش از :value داشته‌باشد.',
        'file' => 'فیلد :attribute باید بزرگتر از :value کیلوبایت باشد.',
        'numeric' => 'فیلد :attribute باید بزرگتر از :value باشد.',
        'string' => 'فیلد :attribute باید بزرگتر از :value کاراکتر باشد.',
    ],
    'gte' => [
        'array' => 'فیلد :attribute باید دارای موارد :value یا بیشتر باشد.',
        'file' => 'فیلد :attribute باید بزرگتر یا برابر :value کیلوبایت باشد.',
        'numeric' => 'فیلد :attribute باید بزرگتر یا برابر :value باشد.',
        'string' => 'فیلد :attribute باید بزرگتر یا برابر :value کاراکتر باشد.',
    ],
    'image' => 'فیلد :attribute باید یک تصویر باشد.',
    'in' => 'attribute : انتخاب شده نامعتبر است.',
    'in_array' => 'فیلد :attribute باید در :other وجود داشته‌باشد.',
    'integer' => 'فیلد :attribute باید یک عدد صحیح باشد.',
    'ip' => 'فیلد :attribute باید یک آدرس IP معتبر باشد.',
    'ipv4' => 'فیلد :attribute باید یک آدرس IPv4 معتبر باشد.',
    'ipv6' => 'فیلد :attribute باید یک آدرس IPv6 معتبر باشد.',
    'json' => 'فیلد :attribute باید یک رشته JSON معتبر باشد.',
    'lowercase' => 'فیلد :attribute باید حروف کوچک باشد.',
    'lt' => [
        'array' => 'فیلد :attribute باید مقداری کمتر از :value داشته‌باشد.',
        'file' => 'فیلد :attribute باید کمتر از :value کیلوبایت باشد.',
        'numeric' => 'فیلد :attribute باید کمتر از :value باشد.',
        'string' => 'فیلد :attribute باید کمتر از :value کاراکتر باشد.',
    ],
    'lte' => [
        'array' => 'فیلد :attribute باید دارای موارد :value یا کمتر باشد',
        'file' => 'فیلد :attribute باید کمتر یا برابر :value کیلوبایت باشد.',
        'numeric' => 'فیلد :attribute باید کمتر یا برابر :value باشد.',
        'string' => 'فیلد :attribute باید کمتر یا برابر :value کاراکتر باشد.',
    ],
    'mac_address' => 'فیلد :attribute باید یک آدرس MAC معتبر باشد.',
    'max' => [
        'array' => 'فیلد :attribute نباید بیش از :max آیتم داشته‌باشد.',
        'file' => 'فیلد :attribute نباید از :max کیلوبایت بیشتر باشد.',
        'numeric' => 'فیلد :attribute نباید بیشتر از :max باشد.',
        'string' => 'فیلد :attribute نباید بیشتر از :max کاراکتر باشد.',
    ],
    'max_digits' => 'فیلد :attribute نباید بیش از :max ارقام داشته‌باشد.',
    'mimes' => 'فیلد :attribute باید فایلی از نوع: :values باشد.',
    'mimetypes' => 'فیلد :attribute باید فایلی از نوع: :values باشد.',
    'min' => [
        'array' => 'فیلد :attribute باید حداقل  :min آیتم داشته‌باشد.',
        'file' => 'فیلد :attribute باید حداقل :min کیلوبایت باشد.',
        'numeric' => 'فیلد :attribute باید حداقل :min باشد.',
        'string' => 'فیلد :attribute باید حداقل :min کاراکتر باشد.',
    ],
    'min_digits' => 'فیلد :attribute باید حداقل دارای  :min رقم باشد.',
    'missing' => 'فیلد :attribute باید وجود نداشته‌باشد.',
    'missing_if' => 'وقتی :other :value باشد باید فیلد :attribute وجود نداشته‌باشد.',
    'missing_unless' => 'فیلد :attribute باید وجود نداشته‌باشد مگر اینکه :other :value باشد.',
    'missing_with' => 'وقتی :values وجود دارد، فیلد :attribute باید وجود نداشته‌باشد.',
    'missing_with_all' => 'وقتی :values وجود دارد باید فیلد :attribute وجود نداشته‌باشد.',
    'multiple_of' => 'فیلد :attribute باید مضرب :value باشد.',
    'not_in' => 'ویژگی : انتخاب شده نامعتبر است.',
    'not_regex' => 'قالب فیلد :attribute نامعتبر است.',
    'numeric' => 'فیلد :attribute باید یک عدد باشد.',
    'password' => [
        'letters' => 'فیلد :attribute باید حداقل دارای یک حرف باشد.',
        'mixed' => 'فیلد :attribute باید حداقل دارای یک حرف بزرگ و یک حرف کوچک باشد.',
        'numbers' => 'فیلد :attribute باید حداقل دارای یک عدد باشد.',
        'symbols' => 'فیلد :attribute باید حداقل دارای یک نماد باشد.',
        'uncompromised' => 'ویژگی : داده شده در نشت داده ظاهر شده است. لطفاً یک :attribute متفاوت انتخاب کنید.',
    ],
    'present' => 'فیلد :attribute باید وجود داشته‌باشد.',
    'prohibited' => 'فیلد :attribute ممنوع است.',
    'prohibited_if' => 'وقتی :other :value باشد، فیلد :attribute ممنوع است.',
    'prohibited_unless' => 'فیلد :attribute ممنوع است مگر اینکه :other در :values باشد.',
    'prohibits' => 'فیلد :attribute حضور :other را ممنوع می‌کند.',
    'regex' => 'قالب فیلد :attribute نامعتبر است.',
    'required' => ' فیلد :attribute الزامی است.',
    'required_array_keys' => 'فیلد :attribute باید حاوی ورودی هایی برای: :values باشد.',
    'required_if' => 'وقتی :other :value باشد فیلد :attribute لازم است.',
    'required_if_accepted' => 'وقتی :other پذیرفته شود، فیلد :attribute الزامی است.',
    'required_unless' => 'فیلد :attribute الزامی است مگر اینکه :other در :values باشد.',
    'required_with' => 'وقتی :values وجود دارد، فیلد :attribute الزامی است.',
    'required_with_all' => 'وقتی :values وجود دارد، فیلد :attribute الزامی است.',
    'required_without' => 'فیلد :attribute زمانی لازم است که :values وجود نداشته‌باشد.',
    'required_without_all' => 'فیلد :attribute زمانی لازم است که هیچ یک از :values وجود نداشته‌باشد.',
    'same' => 'فیلد :attribute باید با :other مطابقت داشته‌باشد.',
    'size' => [
        'array' => 'فیلد :attribute باید شامل :size آیتم باشد.',
        'file' => 'فیلد :attribute باید :size کیلوبایت باشد.',
        'numeric' => 'فیلد :attribute باید :size باشد.',
        'string' => 'فیلد :attribute باید :size کاراکتر باشد.',
    ],
    'starts_with' => 'فیلد :attribute باید با یکی از موارد زیر شروع شود: :values.',
    'string' => 'فیلد :attribute باید یک رشته باشد.',
    'timezone' => 'فیلد :attribute باید یک منطقه زمانی معتبر باشد.',
    'unique' => ':attribute قبلاً گرفته شده است.',
    'uploaded' => ':attribute بارگذاری نشد.',
    'uppercase' => 'فیلد :attribute باید با حروف بزرگ باشد.',
    'url' => 'فیلد :attribute باید یک URL معتبر باشد.',
    'ulid' => 'فیلد :attribute باید یک ULID معتبر باشد.',
    'uuid' => 'فیلد :attribute باید یک UUID معتبر باشد.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        "name" => "نام",
        "username" => "نام کاربری",
        "family" => "نام خانوادگی",
        "email" => "ایمیل",
        "mail" => "ایمیل",
        "phone" => "تلفن",
        "telephone" => "تلفن ثابت",
        "password" => "گذرواژه",
        "avatar" => "آواتار",
        "title" => "عنوان",
        "slug" => "اسلاگ",
        "body" => "بدنه",
        "excerpt" => "خلاصه",
        "category" => "دسته‌بندی",
        "categories" => "دسته‌بندی‌ها",
        "tag" => "برچسب",
        "attributes" => "برچسب‌ها",
        "featured_image" => "تصویر شاخص",
        "path" => "مسیر",
        "address" => "آدرس",
        "tk-captcha" => "کپچا",
        "token" => "توکن",
        "customers" => "نقش‌ها",
        "g-recaptcha-response" => "کپچا",
        "group_id" => "گروه/دسته",
        "company" => "شرکت",
        "department" => "دپارتمان",
        "message" => "پیغام",
        "activities" => "فعالیت",
        "position"=>"سمت",
        "code_meli"=>"کد ملی",
        "university"=>"دانشگاه",
        "college"=>"دانشکده",
        "file "=>"فایل",
        "target "=>"هدف",
        "users"=>"کابران",
        "roles "=>"نقش‌ها",
    ],

];
