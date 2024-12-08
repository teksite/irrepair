<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Morilog\Jalali\Jalalian;

function serverResponseMessage($code): string
{
    switch ($code) {
        case 100:
            $text = 'Continue';
            break;
        case 101:
            $text = 'Switching Protocols';
            break;

        case 200:
            $text = 'Success';
            break;
        case 201:
            $text = 'Created';
            break;
        case 202:
            $text = 'Accepted';
            break;
        case 203:
            $text = 'Non-Authoritative Information';
            break;
        case 204:
            $text = 'No Content';
            break;
        case 205:
            $text = 'Reset Content';
            break;
        case 206:
            $text = 'Partial Content';
            break;
        case 207 :
            $text = 'Multi-Status';
            break;
        case 208  :
            $text = 'Already Reported';
            break;
        case 226  :
            $text = 'IM Used';
            break;

        case 300:
            $text = 'Multiple Choices';
            break;
        case 301:
            $text = 'Moved Permanently';
            break;
        case 302:
            $text = 'Moved Temporarily';
            break;
        case 303:
            $text = 'See Other';
            break;
        case 304:
            $text = 'Not Modified';
            break;
        case 305:
            $text = 'Use Proxy';
            break;
        case 306:
            $text = 'Switch Proxy';
            break;
        case 307 :
            $text = 'Temporary Redirect';
            break;
        case 308  :
            $text = 'Permanent Redirect';
            break;

        case 400:
            $text = 'Bad Request';
            break;
        case 401:
            $text = 'Unauthorized';
            break;
        case 402:
            $text = 'Payment Required';
            break;
        case 403:
            $text = 'Forbidden';
            break;
        case 404:
            $text = 'Not Found';
            break;
        case 405:
            $text = 'Method Not Allowed';
            break;
        case 406:
            $text = 'Not Acceptable';
            break;
        case 407:
            $text = 'Proxy Authentication Required';
            break;
        case 408:
            $text = 'Request Time-out';
            break;
        case 409:
            $text = 'Conflict';
            break;
        case 410:
            $text = 'Gone';
            break;
        case 411:
            $text = 'Length Required';
            break;
        case 412:
            $text = 'Precondition Failed';
            break;
        case 413:
            $text = 'Request Entity Too Large';
            break;
        case 414:
            $text = 'Request-URI Too Large';
            break;
        case 415:
            $text = 'Unsupported Media Type';
            break;
        case 416:
            $text = 'Range Not Satisfiable';
            break;
        case 417 :
            $text = 'Expectation Failed';
            break;
        case 418 :
            $text = 'I am a teapot';
            break;
        case 421  :
            $text = 'Misdirected Request';
            break;
        case 422   :
            $text = 'Unprocessable Content';
            break;
        case 423  :
            $text = 'Locked';
            break;
        case 424   :
            $text = 'Failed Dependency';
            break;
        case 425    :
            $text = 'Too Early';
            break;
        case 426     :
            $text = 'Upgrade Required';
            break;
        case 428     :
            $text = 'Precondition Required';
            break;
        case 431       :
            $text = 'Request Header Fields Too Large';
            break;
        case 451       :
            $text = 'Unavailable For Legal Reasons ';
            break;

        case 500:
            $text = 'Internal Server Error';
            break;
        case 501:
            $text = 'Not Implemented';
            break;
        case 502:
            $text = 'Bad Gateway';
            break;
        case 503:
            $text = 'Service Unavailable';
            break;
        case 504:
            $text = 'Gateway Time-out';
            break;
        case 505:
            $text = 'HTTP Version not supported';
            break;
        case 506 :
            $text = 'Variant Also Negotiates';
            break;
        case 507 :
            $text = 'Insufficient Storage';
            break;
        case 508  :
            $text = 'Loop Detected';
            break;
        case 510  :
            $text = 'Not Extended';
            break;
        case 511  :
            $text = 'Network Authentication Required';
            break;
        default:
            exit('Unknown http status code "' . htmlentities($code) . '"');
    }
    return $text;
}
/*
 * Convert string to slug
 */
function changeToSlug(string $slug, string $separator = '-'): \Illuminate\Support\Stringable
{
    $slug = preg_replace_callback('/[A-Z]/', function ($matches) {
        return ' ' . strtolower($matches[0]);
    }, $slug);
    $slug = preg_replace('/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/', 'a', $slug);
    $slug = preg_replace('/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/', 'e', $slug);
    $slug = preg_replace('/i|í|ì|ỉ|ĩ|ị/', 'i', $slug);
    $slug = preg_replace('/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/', 'o', $slug);
    $slug = preg_replace('/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/', 'u', $slug);
    $slug = preg_replace('/ý|ỳ|ỷ|ỹ|ỵ/', 'y', $slug);
    $slug = preg_replace('/đ/', 'd', $slug);

    return Str::of($slug)->slug('-', null);
}

/*
 * Convert date to Jalali or Gregorian based on local in app.php in config directory
 */
function dateAdapter($time, $format = "Y-m-d H:i"): ?string
{
    if (is_null($time)) return null;
    return config('app.locale') == 'fa' ? Jalalian::forge(Carbon::parse($time))->format($format) : Carbon::parse($time)->format($format);
}
/*
 * Write log documents
 */
function logToInfoFile($message): void
{
    $message .= "\n#####\n";
    Log::channel('infoLog')->info($message);
}

function toEnglishNumber(String $string): String {
    $persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $arabicDigits = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];
    $allPersianDigits = array_merge($persianDigits, $arabicDigits);
    $replaces = [...range(0, 9), ...range(0, 9)];

    return str_replace($allPersianDigits, $replaces , $string);
}

if (!function_exists('convertArabicAndPersianToEnglish')) {
    /**
     * Convert Arabic and Persian numbers to English and replace Arabic chars with Persian recursively.
     *
     * @param mixed $input
     * @return mixed
     */
    function convertArabicAndPersianToEnglish($input)
    {
        // Compile replacements only once
        static $numberPattern = '/[٠١٢٣٤٥٦٧٨٩۰۱۲۳۴۵۶۷۸۹]/u';
        static $charPattern = '/[يكهةئؤ]/u';
        static $numberReplacements = [
            '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4',
            '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9',
            '۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4',
            '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9',
        ];
        static $charReplacements = [
            'ي' => 'ی', 'ك' => 'ک', 'ة' => 'ه', 'ئ' => 'ی', 'ؤ' => 'و',
        ];

        // Recursive processing for arrays
        if (is_array($input)) {
            foreach ($input as &$value) {
                $value = convertArabicAndPersianToEnglish($value);
            }
            return $input;
        }

        // Process only strings
        if (is_string($input)) {
            // Replace numbers and characters using strtr for speed
            return strtr(strtr($input, $numberReplacements), $charReplacements);
        }

        // Return unmodified if not a string or array
        return $input;
    }
}

function exploding(string|null $string)
{
    if (is_null($string)) return null;
    $array = [];
    $ExplodedData = explode(',', $string);
    foreach ($ExplodedData as $Exploded) {
        $array[] = trim($Exploded);
    }

    return collect($array)->map(fn($item) => explode('،', $item))->flatten()->map(fn($item) => trim($item));
}

/*
 * Convert seconds to hours , minutes and seconds
 */
function convertSeconds(int|null $seconds = null,?string $format = null): string|array
{
    if (is_null($seconds)) return "00:00:00";
    $hours = floor($seconds / 3600) > 9 ? floor($seconds / 3600) : '0' . floor($seconds / 3600);
    $minutes = floor(($seconds / 60) % 60) > 9 ? floor(($seconds / 60) % 60) : '0' . floor(($seconds / 60) % 60);
    $sec = $seconds % 60 > 9 ? $seconds % 60 : '0' . $seconds % 60;
    return $format === 'array' ?
        ['hours' => (integer)$hours, 'minutes' => (integer)$minutes, 'seconds' => (integer)$sec] :
        $hours . ':' . $minutes . ':' . $sec;
}
