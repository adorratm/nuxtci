<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Seo
function seo($str = null, $options = [])
{
    $str = mb_convert_encoding($str, "UTF-8");
    $defaults = [
        'delimiter' => '-',
        'limit' => null,
        'lowercase' => true,
        'replacements' => [],
        'transliterate' => true
    ];
    $options = array_merge($defaults, $options);
    $char_map = [
        // Latin
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
        'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
        'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
        'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
        'ß' => 'ss',
        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
        'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
        'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
        'ÿ' => 'y',
        // Latin symbols
        '©' => '(c)',
        // Greek
        'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
        'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
        'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
        'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
        'Ϋ' => 'Y',
        'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
        'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
        'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
        'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
        'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
        // Turkish
        'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
        'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
        // Russian
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
        'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
        'Я' => 'Ya',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
        'я' => 'ya',
        // Ukrainian
        'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
        'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
        // Czech
        'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
        'Ž' => 'Z',
        'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
        'ž' => 'z',
        // Polish
        'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
        'Ż' => 'Z',
        'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
        'ż' => 'z',
        // Latvian
        'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
        'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
        'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
        'š' => 's', 'ū' => 'u', 'ž' => 'z'
    ];
    $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
    $str = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '-', $str);
    if ($options['transliterate']) :
        $str = str_replace(array_keys($char_map), $char_map, $str);
    endif;
    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
    $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
    $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
    $str = trim($str, $options['delimiter']);
    return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}
function clean($data)
{
    $t = &get_instance();
    // Fix &entity\n;
    if (!empty($data)) :
        $data = str_replace(['&amp;', '&lt;', '&gt;'], ['&amp;amp;', '&amp;lt;', '&amp;gt;'], $data);

        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

        // Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

        // Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

        // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

        // Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

        do {
            // Remove really unwanted tags
            $old_data = $data;
            $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        } while ($old_data !== $data);
        $data = htmlspecialchars(addslashes(strip_tags(trim($data))));
        return $t->security->xss_clean($data);
    endif;
    // we are done...
    return null;
}
// Improved Strto
function strto($to, $str)
{
    if (!function_exists('rp')) :
        function rp($i, $str)
        {
            $B = array('I', 'Ğ', 'Ü', 'Ş', 'İ', 'Ö', 'Ç');
            $k = array('ı', 'ğ', 'ü', 'ş', 'i', 'ö', 'ç');
            $Bi = array(' I', ' ı', ' İ', ' i');
            $ki = array(' I', ' I', ' İ', ' İ');
            if ($i == 1 && !empty($str)) :
                return str_replace($B, $k, $str);
            elseif ($i == 2 && !empty($str)) :
                return str_replace($k, $B, $str);
            elseif ($i == 3 && !empty($str)) :
                return str_replace($Bi, $ki, $str);
            else :
                return $str;
            endif;
        }
    endif;
    if (!function_exists('cf')) :
        function cf($c = [], $str = null)
        {
            foreach ($c as $cc) {
                $s = explode($cc, $str);
                foreach ($s as $k => $ss) {
                    $s[$k] = strto('ucfirst', $ss);
                }
                $str = implode($cc, $s);
            }
            return $str;
        }
    endif;
    if (!function_exists('te')) :
        function te()
        {
            return trigger_error('Lütfen geçerli bir strto() parametresi giriniz.', E_USER_ERROR);
        }
    endif;
    $to = explode('|', $to);
    if (!empty($to) && !empty($str)) :
        foreach ($to as $t) :
            if ($t == 'lower' && !empty($str)) :
                $str = mb_strtolower(rp(1, $str), "utf-8");
            elseif ($t == 'upper' && !empty($str)) :
                $str = mb_strtoupper(rp(2, $str), "utf-8");
            elseif ($t == 'ucfirst' && !empty($str)) :
                $str = mb_strtoupper(rp(2, mb_substr($str, 0, 1, "utf-8")), "utf-8") . mb_substr($str, 1, mb_strlen($str, "utf-8") - 1, "utf-8");
            elseif ($t == 'ucwords' && !empty($str)) :
                $str = ltrim(mb_convert_case(rp(3, ' ' . $str), MB_CASE_TITLE, "utf-8"));
            elseif ($t == 'capitalizefirst' && !empty($str)) :
                $str = cf(array('. ', '.', '? ', '?', '! ', '!', ': ', ':'), $str);
            else :
                $str = te();
            endif;
        endforeach;
    else :
        $str = null;
    endif;
    return $str;
}
// Turkish Date
function turkishDate($f, $zt = 'now')
{
    if (!empty($f) && !empty($zt)) :
        $z = date("$f", strtotime($zt));
        $donustur = [
            'Monday'    => 'Pazartesi',
            'Tuesday'   => 'Salı',
            'Wednesday' => 'Çarşamba',
            'Thursday'  => 'Perşembe',
            'Friday'    => 'Cuma',
            'Saturday'  => 'Cumartesi',
            'Sunday'    => 'Pazar',
            'January'   => 'Ocak',
            'February'  => 'Şubat',
            'March'     => 'Mart',
            'April'     => 'Nisan',
            'May'       => 'Mayıs',
            'June'      => 'Haziran',
            'July'      => 'Temmuz',
            'August'    => 'Ağustos',
            'September' => 'Eylül',
            'October'   => 'Ekim',
            'November'  => 'Kasım',
            'December'  => 'Aralık',
            'Mon'       => 'Pts',
            'Tue'       => 'Sal',
            'Wed'       => 'Çar',
            'Thu'       => 'Per',
            'Fri'       => 'Cum',
            'Sat'       => 'Cts',
            'Sun'       => 'Paz',
            'Jan'       => 'Oca',
            'Feb'       => 'Şub',
            'Mar'       => 'Mar',
            'Apr'       => 'Nis',
            'Jun'       => 'Haz',
            'Jul'       => 'Tem',
            'Aug'       => 'Ağu',
            'Sep'       => 'Eyl',
            'Oct'       => 'Eki',
            'Nov'       => 'Kas',
            'Dec'       => 'Ara',
        ];
        foreach ($donustur as $en => $tr) :
            $z = str_replace($en, $tr, $z);
        endforeach;
        if (strpos($z, 'Mayıs') !== false && strpos($f, 'F') === false) $z = str_replace('Mayıs', 'May', $z);
        return $z;
    else :
        return null;
    endif;
}
// Turkish Time Ago
function time_ago($timestamp)
{
    date_default_timezone_set("Europe/Istanbul");
    $time_ago        = strtotime($timestamp);
    $current_time    = time();
    $time_difference = $current_time - $time_ago;
    $seconds         = $time_difference;
    $minutes = round($seconds / 60); // value 60 is seconds
    $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec
    $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;
    $weeks   = round($seconds / 604800); // 7*24*60*60;
    $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60
    $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60
    if ($seconds <= 60) :
        return "Henüz";
    elseif ($minutes <= 60) :
        if ($minutes == 1) :
            return "1 Dakika Önce";
        else :
            return "$minutes Dakika Önce";
        endif;
    elseif ($hours <= 24) :
        if ($hours == 1) :
            return "1 Saat Önce";
        else :
            return "$hours Saat Önce";
        endif;
    elseif ($days <= 7) :
        if ($days == 1) :
            return "Dün";
        else :
            return "$days Gün Önce";
        endif;
    elseif ($weeks <= 4.3) :
        if ($weeks == 1) :
            return "1 Hafta Önce";
        else :
            return "$weeks Hafta Önce";
        endif;
    elseif ($months <= 12) :
        if ($months == 1) :
            return "Bir Ay Önce";
        else :
            return "$months Ay Önce";
        endif;
    else :
        if ($years == 1) :
            return "Bir Yıl Önce";
        else :
            return turkishDate('j F Y , l', $timestamp);
        endif;
    endif;
}
// Recursive Xss Clean
function rClean($array)
{
    $cleanedArray = [];
    if (!empty($array)) :
        foreach ($array as $key => $value) :
            if (is_array($key)) :
                $value = rClean($key);
            else :
                $key = clean($key);
            endif;

            if (is_array($value)) :
                $value = rClean($value);
            else :
                $value = clean($value);
            endif;
            $cleanedArray[$key] = $value;
        endforeach;
    endif;
    return $cleanedArray;
}
// Return Json Encoded Value
function makeJSON($array)
{
    $makedArray = [];
    if (!empty($array)) :
        foreach ($array as $key => $value) :
            if (!is_array($value) && isJson($value)) :
                $value = trim($value, '"');
            elseif (!is_array($value) && !isJson($value)) :
                $value = json_encode($value, JSON_UNESCAPED_UNICODE);
            else :
                $value = json_encode($value, JSON_UNESCAPED_UNICODE);
            endif;
            $makedArray[$key] = $value;
        endforeach;
    endif;
    return $makedArray;
}
// IsJSON
function isJson($str)
{
    $json = null;
    if (!empty($str)) :
        $json = json_decode($str, true);
    endif;
    return $json !== NULL;
}
// Format Phone Number
function formatPhoneNumber($phoneNumber)
{
    $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
    if (strlen($phoneNumber) > 10) {
        $countryCode = substr($phoneNumber, 0, strlen($phoneNumber) - 10);
        $areaCode = substr($phoneNumber, -10, 3);
        $nextThree = substr($phoneNumber, -7, 3);
        $lastFour = substr($phoneNumber, -4, 4);
        $phoneNumber = '+' . $countryCode . ' (' . $areaCode . ') ' . $nextThree . '-' . $lastFour;
    } else if (strlen($phoneNumber) == 10) {
        $areaCode = substr($phoneNumber, 0, 3);
        $nextThree = substr($phoneNumber, 3, 3);
        $lastFour = substr($phoneNumber, 6, 4);
        $phoneNumber = '(' . $areaCode . ') ' . $nextThree . '-' . $lastFour;
    } else if (strlen($phoneNumber) == 7) {
        $nextThree = substr($phoneNumber, 0, 3);
        $lastFour = substr($phoneNumber, 3, 4);
        $phoneNumber = $nextThree . '-' . $lastFour;
    }
    return $phoneNumber;
}
// Format Price To Written Text
function sayiyiYaziyaCevir($sayi, $kurusbasamak, $parabirimi, $parakurus, $diyez, $bb1, $bb2, $bb3)
{
    // kurusbasamak virgülden sonra gösterilecek basamak sayısı
    // parabirimi = TL gibi , parakurus = Kuruş gibi
    // diyez başa ve sona kapatma işareti atar # gibi
    $b1 = ["", "Bir ", "İki ", "Üç ", "Dört ", "Beş ", "Altı ", "Yedi ", "Sekiz ", "Dokuz "];
    $b2 = ["", "On ", "Yirmi ", "Otuz ", "Kırk ", "Elli ", "Altmış ", "Yetmiş ", "Seksen ", "Doksan "];
    $b3 = ["", "Yüz ", "Bin ", "Milyon ", "Milyar ", "Trilyon ", "Katrilyon "];
    if ($bb1 != null) : // farklı dil kullanımı yada farklı yazım biçimi için
        $b1 = $bb1;
    endif;
    if ($bb2 != null) : // farklı dil kullanımı
        $b2 = $bb2;
    endif;
    if ($bb3 != null) : // farklı dil kullanımı
        $b3 = $bb3;
    endif;
    $say1 = "";
    $say2 = ""; // say1 virgül öncesi, say2 kuruş bölümü
    $sonuc = "";
    $sayi = str_replace(",", ".", $sayi); //virgül noktaya çevrilir
    $nokta = strpos($sayi, "."); // nokta indeksi
    if ($nokta > 0) : // nokta varsa (kuruş)
        $say1 = substr($sayi, 0, $nokta); // virgül öncesi
        $say2 = substr($sayi, $nokta, strlen($sayi)); // virgül sonrası, kuruş
    else :
        $say1 = $sayi; // kuruş yoksa
    endif;
    $son = "";
    $w = 1; // işlenen basamak
    $sonaekle = 0; // binler on binler yüzbinler vs. için sona bin (milyon,trilyon...) eklenecek mi?
    $kac = strlen($say1); // kaç rakam var?
    $sonint = ""; // işlenen basamağın rakamsal değeri
    $uclubasamak = 0; // hangi basamakta (birler onlar yüzler gibi)
    $artan = 0; // binler milyonlar milyarlar gibi artışları yapar
    $gecici = "";
    if ($kac > 0) : // virgül öncesinde rakam var mı?
        for ($i = 0; $i < $kac; $i++) :
            $son = $say1[$kac - 1 - $i]; // son karakterden başlayarak çözümleme yapılır.
            $sonint = $son; // işlenen rakam Integer.parseInt(
            if ($w == 1) : // birinci basamak bulunuyor
                $sonuc = $b1[$sonint] . $sonuc;
            elseif ($w == 2) : // ikinci basamak
                $sonuc = $b2[$sonint] . $sonuc;
            elseif ($w == 3) : // 3. basamak
                if ($sonint == 1) :
                    $sonuc = $b3[1] . $sonuc;
                elseif ($sonint > 1) :
                    $sonuc = $b1[$sonint] . $b3[1] . $sonuc;
                endif;
                $uclubasamak++;
            endif;
            if ($w > 3) : // 3. basamaktan sonraki işlemler
                if ($uclubasamak == 1) :
                    if ($sonint > 0) :
                        $sonuc = $b1[$sonint] . $b3[2 + $artan] . $sonuc;
                        if ($artan == 0) : // birbin yazmasını engelle
                            $sonuc = str_replace($b1[1] . $b3[2], $b3[2], $sonuc);
                        endif;
                        $sonaekle = 1; // sona bin eklendi
                    else :
                        $sonaekle = 0;
                    endif;
                    $uclubasamak++;
                elseif ($uclubasamak == 2) :
                    if ($sonint > 0) :
                        if ($sonaekle > 0) :
                            $sonuc = $b2[$sonint] . $sonuc;
                            $sonaekle++;
                        else :
                            $sonuc = $b2[$sonint] . $b3[2 + $artan] . $sonuc;
                            $sonaekle++;
                        endif;
                    endif;
                    $uclubasamak++;
                elseif ($uclubasamak == 3) :
                    if ($sonint > 0) :
                        if ($sonint == 1) :
                            $gecici = $b3[1];
                        else :
                            $gecici = $b1[$sonint] . $b3[1];
                        endif;
                        if ($sonaekle == 0) :
                            $gecici = $gecici . $b3[2 + $artan];
                        endif;
                        $sonuc = $gecici . $sonuc;
                    endif;
                    $uclubasamak = 1;
                    $artan++;
                endif;
            endif;
            $w++; // işlenen basamak
        endfor;
    endif; // if(kac>0)
    if ($sonuc == "") : // virgül öncesi sayı yoksa para birimi yazma
        $parabirimi = "";
    endif;
    $say2 = str_replace(".", "", $say2);
    $kurus = "";
    if ($say2 != "") : // kuruş hanesi varsa
        if ($kurusbasamak > 3) : // 3 basamakla sınırlı
            $kurusbasamak = 3;
        endif;
        $kacc = strlen($say2);
        if ($kacc == 1) : // 2 en az
            $say2 = $say2 . "0"; // kuruşta tek basamak varsa sona sıfır ekler.
            $kurusbasamak = 2;
        endif;
        if (strlen($say2) > $kurusbasamak) : // belirlenen basamak kadar rakam yazılır
            $say2 = substr($say2, 0, $kurusbasamak);
        endif;
        $kac = strlen($say2); // kaç rakam var?
        $w = 1;
        for ($i = 0; $i < $kac; $i++) : // kuruş hesabı
            $son = $say2[$kac - 1 - $i]; // son karakterden başlayarak çözümleme yapılır.
            $sonint = $son; // işlenen rakam Integer.parseInt(
            if ($w == 1) : // birinci basamak

                if ($kurusbasamak > 0) :
                    $kurus = $b1[$sonint] . $kurus;
                endif;
            elseif ($w == 2) : // ikinci basamak
                if ($kurusbasamak > 1) :
                    $kurus = $b2[$sonint] . $kurus;
                endif;
            elseif ($w == 3) : // 3. basamak
                if ($kurusbasamak > 2) :
                    if ($sonint == 1) : // 'biryüz' ü engeller
                        $kurus = $b3[1] . $kurus;
                    elseif ($sonint > 1) :
                        $kurus = $b1[$sonint] . $b3[1] . $kurus;
                    endif;
                endif;
            endif;
            $w++;
        endfor;
        if ($kurus == "") : // virgül öncesi sayı yoksa para birimi yazma
            $parakurus = "";
        else :
            $kurus = $kurus . " ";
        endif;
        $kurus = $kurus . $parakurus; // kuruş hanesine 'kuruş' kelimesi ekler
    endif;
    $sonuc = $diyez . $sonuc . " " . $parabirimi . " " . $kurus . $diyez;
    return $sonuc;
}
/**
 * shortens the supplied text after last word
 * @param string $string
 * @param int $max_length
 * @param string $end_substitute text to append, for example "..."
 * @param boolean $html_linebreaks if LF entities should be converted to <br />
 * @return string
 */
function mb_word_wrap($string, $max_length, $end_substitute = null, $html_linebreaks = true)
{
    if (!empty($string)) :
        if ($html_linebreaks) $string = preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
        $string = strip_tags($string); //gets rid of the HTML
    endif;
    if (empty($string) || mb_strlen($string) <= $max_length) :
        if ($html_linebreaks && !empty($string)) $string = nl2br($string);
        return $string;
    endif;
    if ($end_substitute) $max_length -= mb_strlen($end_substitute, 'UTF-8');
    $stack_count = 0;
    while ($max_length > 0) :
        $char = mb_substr($string, --$max_length, 1, 'UTF-8');
        if (preg_match('#[^\p{L}\p{N}]#iu', $char)) : $stack_count++; //only alnum characters
        elseif ($stack_count > 0) :
            $max_length++;
            break;
        endif;
    endwhile;
    $string = mb_substr($string, 0, $max_length, 'UTF-8') . $end_substitute;
    if ($html_linebreaks) $string = nl2br($string);
    return $string;
}
// Function to get the user IP address
function getUserIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) :
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) :
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else :
        $ip = $_SERVER['REMOTE_ADDR'];
    endif;
    if ($ip === "::1") :
        $ip = "localhost";
    endif;
    return $ip;
}
function get_active_user()
{
    $t = &get_instance();
    $user = $t->session->userdata("user");
    if ($user) {
        return $user;
    } else {
        return false;
    }
}
function getControllerList()
{
    $t = &get_instance();
    $controllers = [];
    $t->load->helper("file");
    $files = get_dir_file_info(APPPATH . "controllers", FALSE);
    if (!empty($files)) :
        foreach (array_keys($files) as $file) :
            if ($file !== "index.html") :
                $controllers[] = strtolower(str_replace(".php", '', $file));
            endif;
        endforeach;
    endif;
    return $controllers;
}
function get_controller_name($seo)
{
    $tr = [
        'dashboard' => "Dashboard",
        'settings' => "Ayarlar",
        'emailsettings' => "E-Posta Ayarları",
        'galleries' => "Galeri İşlemleri",
        'stories' => "Hikaye İşlemleri",
        'slides' => "Slider",
        'blog_categories' => "Blog Kategorileri",
        'blogs' => "Blog",
        'user_role' => "Kullanıcı Yetkileri",
        'users' => "Kullanıcılar",
        'questions' => "Soru (SSS)",
        'pages' => "Sayfalar",
        'brands' => "Markalar",
        'testimonials' => "Ziyaretçi Notları",
        'popups' => "Popup Hizmeti",
        'ads' => "Reklamlar"
    ];
    if (!empty($tr)) :
        foreach ($tr as $key => $v) :
            if ($key == $seo) :
                return $v;
            endif;
        endforeach;
    endif;
}
function isAllowedViewModule($modulName = "")
{
    $t = &get_instance();
    $modulName = (empty($modulName)) ? $t->router->fetch_class() : $modulName;
    $user = get_active_user();
    $user_roles = $t->session->userdata('user_roles');
    if (isset($user_roles[$user->role_id])) :
        $permission = json_decode($user_roles[$user->role_id]);
        if (isset($permission->$modulName) && isset($permission->$modulName->read)) :
            return true;
        endif;
    endif;
    return false;
}
function isAllowedWriteViewModule($modulName = "")
{
    $t = &get_instance();
    $modulName = (empty($modulName)) ? $t->router->fetch_class() : $modulName;
    $user = get_active_user();
    $user_roles = $t->session->userdata('user_roles');
    if (isset($user_roles[$user->role_id])) :
        $permission = json_decode($user_roles[$user->role_id]);
        if (isset($permission->$modulName) && isset($permission->$modulName->write)) :
            return true;
        endif;
    endif;
    return false;
}
function isAllowedUpdateViewModule($modulName = "")
{
    $t = &get_instance();
    $modulName = (empty($modulName)) ? $t->router->fetch_class() : $modulName;
    $user = get_active_user();
    $user_roles = $t->session->userdata('user_roles');
    if (isset($user_roles[$user->role_id])) :
        $permission = json_decode($user_roles[$user->role_id]);
        if (isset($permission->$modulName) && isset($permission->$modulName->update)) :
            return true;
        endif;
    endif;
    return false;
}
function isAllowedDeleteViewModule($modulName = "")
{
    $t = &get_instance();
    $modulName = (empty($modulName)) ? $t->router->fetch_class() : $modulName;
    $user = get_active_user();
    $user_roles = $t->session->userdata('user_roles');
    if (isset($user_roles[$user->role_id])) :
        $permission = json_decode($user_roles[$user->role_id]);
        if (isset($permission->$modulName) && isset($permission->$modulName->delete)) :
            return true;
        endif;
    endif;
    return false;
}
function userRole()
{
    $t = &get_instance();
    $t->load->model("user_role_model");
    $c = $t->user_role_model->get_all(['isActive' => 1]);
    $roles = [];
    if (!empty($c)) :
        foreach ($c as $v) :
            $roles[$v->id] = $v->permissions;
        endforeach;
    endif;
    $t->session->set_userdata('user_roles', $roles);
}
function send_emailv2($toEmail = [], $subject = null, $message = null, $attachments = [], $lang = "tr", $mail_settings = 1)
{
    $t = &get_instance();
    $email_settings = $t->general_model->get("email_settings", null, ["isActive" => 1, "id" => $mail_settings, "lang" => $lang]);
    $email_settings->host = !empty($email_settings->host) ? $email_settings->host : null;
    $email_settings->port = !empty($email_settings->port) ? $email_settings->port : null;
    $email_settings->protocol = !empty($email_settings->protocol) ? $email_settings->protocol : null;
    $email_settings->user_name = !empty($email_settings->user_name) ? $email_settings->user_name : null;
    $email_settings->user = !empty($email_settings->user) ? $email_settings->user : null;
    $email_settings->password = !empty($email_settings->password) ? $email_settings->password : null;
    $email_settings->from = !empty($email_settings->from) ? $email_settings->from : null;
    $email_settings->to = !empty($email_settings->to) ? $email_settings->to : null;
    $transport = (new Swift_SmtpTransport($email_settings->host, intval($email_settings->port), strto("lower", $email_settings->protocol)))
        ->setUsername($email_settings->user)
        ->setPassword($email_settings->password);
    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);
    if (empty($toEmail)) :
        $toEmail = [$email_settings->user];
    endif;
    // Create a message
    $msg = (new Swift_Message($subject))
        ->setFrom([$email_settings->from => $email_settings->user])
        ->setTo($toEmail)
        ->setCharset('utf-8');
    $msg->setBody($message, 'text/html', 'utf-8');
    if (!empty($attachments)) :
        foreach ($attachments as $key => $value) :
            $msg->attach(Swift_Attachment::fromPath($value));
        endforeach;
    endif;
    // Send the message
    $result = $mailer->send($msg);
    if ($result) :
        return true;
    else :
        return false;
    endif;
}
function get_settings()
{
    $t = &get_instance();
    $t->load->model("settings_model");
    if ($t->session->userdata("settings")) :
        $settings = $t->session->userdata("settings");
    else :
        $settings = $t->settings_model->get();
        if (empty($settings)) :
            $settings = new stdClass();
            $settings->company_name = "CMS";
            $settings->logo = "default";
        endif;
        $t->session->set_userdata("settings", $settings);
    endif;
    return $settings;
}
function upload_picture($file, $uploadPath, $resize = [], $allowedTypes = "bmp|gif|jpeg|jpg|jpe|jp2|j2k|jpf|jpg2|jpx|jpm|mj2|mjp2|tiff|tif|svg|ico|png|webp")
{
    $t = &get_instance();
    if (!is_dir("{$uploadPath}")) :
        mkdir("{$uploadPath}", 0755, true);
    endif;
    $config = [];
    $config["upload_path"] = FCPATH . "{$uploadPath}";
    $config["allowed_types"] = $allowedTypes;
    $config["encrypt_name"] = TRUE;
    $t->load->library("upload", $config);
    $t->upload->initialize($config);
    if (!$t->upload->do_upload($file)) :
        return ["success" => false, "error" => $t->upload->display_errors()];
    else :
        if (!empty($resize)) :
            $image_data =   $t->upload->data();
            $configer =  [
                'image_library'   => 'gd2',
                'source_image'    =>  $image_data['full_path'],
                'maintain_ratio'  => (!empty($resize["maintain_ratio"]) ? $resize["maintain_ratio"] : FALSE),
                'height'          => (!empty($resize["height"]) ? $resize["height"] : 1280),
                'width'           => (!empty($resize["width"]) ? $resize["width"] : 1920),
                'master_dim'      => (!empty($resize["master_dim"]) ? $resize["master_dim"] : 'height'),
                'quality'         => '85%'
            ];
            $t->image_lib->clear();
            $t->image_lib->initialize($configer);
            $t->image_lib->resize();
        endif;
        $imageTypes = "bmp|gif|jpeg|jpg|jpe|jp2|j2k|jpf|jpg2|jpx|jpm|mj2|mjp2|tiff|tif|svg|ico|png";
        $sourceArray = explode(".", $t->upload->data()["file_name"]);
        $extension = $sourceArray[array_search(end($sourceArray), $sourceArray, true)];
        $source = null;
        if (strpos($imageTypes, $extension) !== false) :
            unset($sourceArray[array_search(end($sourceArray), $sourceArray, true)]);
            foreach ($sourceArray as $k => $v) :
                $source .= $v;
            endforeach;
            $source .= ".webp";
            Webp2($config["upload_path"] . DIRECTORY_SEPARATOR . $t->upload->data()["file_name"]);
        else :
            $source = $t->upload->data()["file_name"];
        endif;
        return ["success" => true, "file_name" => $source];
    endif;
}
function get_picture($path = "", $picture = "")
{
    if ($picture != "") :
        if (file_exists(FCPATH . "uploads/$path/$picture")) :
            $picture = base_url("uploads/$path/$picture");
        else :
            $picture = base_url("assets/img/default_image.webp");
        endif;
    else :
        $picture = base_url("assets/img/default_image.webp");
    endif;
    return $picture;
}
function rrmdir($dir)
{
    if (is_dir($dir)) :
        $objects = scandir($dir);
        if (!empty($objects)) :
            foreach ($objects as $object) :
                if ($object != "." && $object != "..") :
                    if (is_dir($dir . "/" . $object) && !is_link($dir . "/" . $object))
                        rrmdir($dir . "/" . $object);
                    else
                        unlink($dir . "/" . $object);
                endif;
            endforeach;
        endif;
        rmdir($dir);
    endif;
}
function checkEmpty($data = [])
{
    $error = false;
    if (!empty($data)) :
        foreach ($data as $key => $value) :
            if (is_array($value)) :
                foreach ($value as $k => $v) :
                    if ((empty($v))) :
                        $error = true;
                        return ["error" => $error, "key" => (!empty($k) ? $v : null)];
                    endif;
                endforeach;
            else :
                if (!empty($value)) :
                    $value = clean(trim($value));
                else :
                    $value = null;
                endif;
            endif;
            if ((empty($value))) :
                $error = true;
                return ["error" => $error, "key" => (!empty($key) ? $key : null)];
            endif;
        endforeach;
    endif;
    return ["error" => $error, "key" => (!empty($key) ? $key : null)];
}
function Webp2($source, $quality = 70)
{
    if (file_exists($source)) :
        $extension = pathinfo($source, PATHINFO_EXTENSION);
        $image = null;
        if ($extension !== "webp") :
            if ($extension == "jpeg" || $extension == "jpg") :
                $image = @imagecreatefromjpeg($source);
                if (!$image) :
                    $image = imagecreatefromstring(file_get_contents($source));
                endif;
            elseif ($extension == "gif") :
                $image = @imagecreatefromgif($source);
                if (!$image) :
                    $image = imagecreatefromstring(file_get_contents($source));
                endif;
            elseif ($extension == "png") :
                $image = @imagecreatefrompng($source);
                if (!$image) :
                    $image = imagecreatefromstring(file_get_contents($source));
                endif;
            else :
                if ($extension == "jpg" || $extension == "png" || $extension == "gif" || $extension == "wbm" || $extension == "gd2" || $extension == "bmp" || $extension == "webp" || $extension == "jpeg") :
                    $image = imagecreatefromstring(file_get_contents($source));
                else :
                    $image = null;
                endif;
            endif;
            $oldSource = $source;
            $source = substr($source, 0, strrpos($source, "."));
            $source .= ".webp";
            if (!empty($image)) :
                imagepalettetotruecolor($image);
                imagealphablending($image, true);
                imagesavealpha($image, true);
                $img =  imagewebp($image, $source, (int)$quality);
                imagedestroy($image);
            else :
                $img = null;
            endif;
            if (file_exists($oldSource)) :
                @unlink($oldSource);
            endif;
            return $img;
        endif;
    endif;
}
function rWebp2($dir)
{
    $result = [];
    $cdir = scandir($dir);
    if (!empty($cdir)) :
        foreach ($cdir as $key => $value) :
            if (!in_array($value, array(".", ".."))) :
                if (!is_dir($dir . DIRECTORY_SEPARATOR . $value)) :
                    $result[] = $dir . DIRECTORY_SEPARATOR . $value;
                    Webp2($dir . DIRECTORY_SEPARATOR . $value);
                else :
                    rWebp2($dir . DIRECTORY_SEPARATOR . $value);
                endif;
            endif;
        endforeach;
    endif;
}
