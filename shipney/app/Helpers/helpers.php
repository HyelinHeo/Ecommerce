<?php
/**
 * File name: helpers.php
 * Last modified: 2020.05.27 at 18:36:19
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

use InfyOm\Generator\Common\GeneratorField;
use InfyOm\Generator\Utils\GeneratorFieldsInputUtil;
use InfyOm\Generator\Utils\HTMLFieldGenerator;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

/**
 * @param $bytes
 * @param int $precision
 * @return string
 */
function formatedSize($bytes, $precision = 1)
{
    $units = array('B', 'KB', 'MB', 'GB', 'TB');

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    $bytes /= pow(1024, $pow);

    return round($bytes, $precision) . ' ' . $units[$pow];
}

function getMediaColumn($mediaModel, $mediaCollectionName = '', $optionClass = '', $mediaThumbnail = 'icon')
{
    $optionClass = $optionClass == '' ? ' rounded ' : $optionClass;

    if ($mediaModel->hasMedia($mediaCollectionName)) {
        return "<img class='" . $optionClass . "' style='width:50px' src='" . $mediaModel->getFirstMediaUrl($mediaCollectionName, $mediaThumbnail) . "' alt='" . $mediaModel->getFirstMedia($mediaCollectionName)->name . "'>";
    }else{
        return "<img class='" . $optionClass . "' style='width:50px' src='" . asset('images/image_default.png') . "' alt='image_default'>";
    }
}

function getPhotoColumn($mediaModel, $mediaCollectionName = '', $optionClass = '', $mediaThumbnail = 'icon', $width='50px')
{
    $optionClass = $optionClass == '' ? ' rounded ' : $optionClass;
    if (isset($mediaModel->$mediaCollectionName)) {
        return "<img class='" . $optionClass . "' style='width:$width' src='" . $mediaModel->$mediaCollectionName . "' >";
    }else{
        return "<img class='" . $optionClass . "' style='width:$width' src='" . asset('images/image_default.png') . "' alt='image_default'>";
    }
}

//add function_20210726_hyerin
//Click on the picture to pop up in a larger size.
function getExpandPhoto($mediaModel, $mediaCollectionName = '')
{
    $imgHTML="";
    if (isset($mediaModel->$mediaCollectionName)) {
        $imgHTML = "<div style='position:relative;'>
                        <a href='javascript:;' onClick='document.getElementById(".'"lay_pop_'.$mediaCollectionName.'"'.").style.display = ".'"block"'.";'>
                            <img style='width:50px' src='" . $mediaModel->$mediaCollectionName . "'>
                        </a>";
        $imgHTML.= "<div id='lay_pop_$mediaCollectionName' style='display:none;'>
                            <a href='javascript:;' onClick='document.getElementById(".'"lay_pop_'.$mediaCollectionName.'"'.").style.display = ".'"none"'.";'>
                                <img style='position:absolute;z-index:200;max-height:1000px;width:320px;top:-50%;-webkit-box-shadow:0 100px 100px 0 #cccccc; box-shadow:0 100px 100px 0 #cccccc;' src='" . $mediaModel->$mediaCollectionName . "' >
                            </a>
                        </div>
                    </div>";
    }else{
        $imgHTML.= "<img style='width:50px' src='" . asset('images/image_default.png') . "' alt='image_default'>";
    }
    return $imgHTML;
}

//add function_20211005_hyerin
//Click on the picture to pop up in a larger size. on another side
function getExpandPhotoForTrans($mediaModel, $mediaCollectionName = '', $isLeft=true)
{
    $imgHTML="";
    if (isset($mediaModel->$mediaCollectionName)) {
        $imgHTML = "<div style='position:relative;'>
                        <a href='javascript:;' onClick='document.getElementById(".'"lay_pop_'.$mediaCollectionName.'"'.").style.display = ".'"block"'.";'>
                            <img style='width:50px' src='" . $mediaModel->$mediaCollectionName . "'>
                        </a>";
        if($isLeft){
            $imgHTML.= "<div id='lay_pop_$mediaCollectionName' style='display:none;'>
                                <a href='javascript:;' onClick='document.getElementById(".'"lay_pop_'.$mediaCollectionName.'"'.").style.display = ".'"none"'.";'>
                                    <img style='position:absolute;z-index:200;max-height:1000px;width:320px;left:150%;top:-50%;-webkit-box-shadow:0 100px 100px 0 #cccccc; box-shadow:0 100px 100px 0 #cccccc;' src='" . $mediaModel->$mediaCollectionName . "' >
                                </a>
                            </div>
                        </div>";
        }else{
            $imgHTML.= "<div id='lay_pop_$mediaCollectionName' style='display:none;'>
                                <a href='javascript:;' onClick='document.getElementById(".'"lay_pop_'.$mediaCollectionName.'"'.").style.display = ".'"none"'.";'>
                                    <img style='position:absolute;z-index:200;max-height:1000px;width:320px;left:-150%;top:-50%;-webkit-box-shadow:0 100px 100px 0 #cccccc; box-shadow:0 100px 100px 0 #cccccc;' src='" . $mediaModel->$mediaCollectionName . "' >
                                </a>
                            </div>
                        </div>";
        }
    }else{
        $imgHTML.= "<img style='width:50px' src='" . asset('images/image_default.png') . "' alt='image_default'>";
    }
    return $imgHTML;
}

/**
 * @param $modelObject
 * @param string $attributeName
 * @return null|string|string[]
 */
function getDateColumn($modelObject, $attributeName = 'updated_at')
{
    if (setting('is_human_date_format', false)) {
        $html = '<p data-toggle="tooltip" data-placement="bottom" title="${date}">${dateHuman}</p>';
    } else {
        $html = '<p data-toggle="tooltip" data-placement="bottom" title="${dateHuman}">${date}</p>';
    }
    if (!isset($modelObject[$attributeName])) {
        return '';
    }
    $dateObj = new Carbon\Carbon($modelObject[$attributeName]);
    $replace = preg_replace('/\$\{date\}/', $dateObj->format(setting('date_format', 'l jS F Y (h:i:s)')), $html);
    $replace = preg_replace('/\$\{dateHuman\}/', $dateObj->diffForHumans(), $replace);
    return $replace;
}

function getPriceColumn($modelObject, $attributeName = 'price')
{

    if ($modelObject[$attributeName] != null && strlen($modelObject[$attributeName]) > 0) {
        $modelObject[$attributeName] = number_format((float)$modelObject[$attributeName], 2, '.', '');
        if (setting('currency_right', false) != false) {
            return $modelObject[$attributeName] . "<span>" . setting('default_currency') . "</span>";
        } else {
            return "<span>" . setting('default_currency') . "</span>" . $modelObject[$attributeName];
        }
    }
    return '-';
}

function getPrice($price = 0)
{
    if (setting('currency_right', false) != false) {
        return number_format((float)$price, 2, '.', '') . "<span>" . setting('default_currency') . "</span>";
    } else {
        return "<span>" . setting('default_currency') . "</span>" . number_format((float)$price, 0, '.', ',');
    }
}

//add function_20210712_hyerin
function getAuthDate($date = null)
{
    if(!isset($date)){
        return "--";
    }
    $arr = str_split($date, 2); 
    if(strlen($date)>9){
        return $arr[0].$arr[1]."-".$arr[2]."-".$arr[3]." ".$arr[4].":".$arr[5].":".$arr[6];
    }
    else{
        return $arr[0].$arr[1]."-".$arr[2]."-".$arr[3];
    }
}

//add function_20210805_hyerin
function getDiffDate($column, $attributeName)
{
    if (isset($column)) {
        if($column[$attributeName]){
            $startDate=new DateTime($column[$attributeName]);
            $now=now();
            $diff=date_diff($startDate,$now);
            return "<span class='badge badge-danger'>" . __('lang.days_before', ['days' => __($diff->days)]) . "</span>";
        }
        else{
            return "--";
        }
    }
}

/**
 * add function_20211101_hyerin
 * generate boolean column for notifications datatable (is done or not)
 * @param $column
 * @return string
 */
function getDoneColumn($column, $attributeName)
{
    if (isset($column)) {
        if ($column[$attributeName]==1) {
            return "<span class='badge badge-success'>" . trans('lang.user_feedback_complete') . "</span>";
        } else {
            return "<span class='badge badge-danger'>" . trans('lang.user_feedback_incomplete') . "</span>";
        }
    }
}

/**
 * add function_20211118_hyerin
 * generate display home mode column for events, coupon datatable (top, mid, bottom)
 * @param $column
 * @return string
 */
function getDisplayHomeModeColumn($column, $attributeName)
{
    if (isset($column)) {
        $binary = sprintf("%03b", $column[$attributeName]);
        $str=str_split($binary);
        $html="";
        if ($column[$attributeName]==0) {
            $html = "<span class='badge badge-light'>" . trans('lang.dispHomeMode_none') . "</span>";
        } else {
            if($str[0] == 1){
                $html .= "<span class='badge badge-info'>" . trans('lang.dispHomeMode_top') . "</span>";
            }
            if($str[1] == 1){
                $html .= "<span class='badge badge-info'>" . trans('lang.dispHomeMode_mid') . "</span>";
            }
            if($str[2] == 1){
                $html .= "<span class='badge badge-info'>" . trans('lang.dispHomeMode_bottom') . "</span>";
            }
        }
        return $html;
    }
}

/**
 * generate boolean column for datatable
 * @param $column
 * @return string
 */
function getBooleanColumn($column, $attributeName)
{
    if (isset($column)) {
        if ($column[$attributeName]) {
            return "<span class='badge badge-success'>" . trans('lang.yes') . "</span>";
        } else {
            return "<span class='badge badge-danger'>" . trans('lang.no') . "</span>";
        }
    }
}

function getBoolean($boolean)
{
    if ($boolean) {
        return "<span class='badge badge-success'>" . trans('lang.yes') . "</span>";
    } else {
        return "<span class='badge badge-danger'>" . trans('lang.no') . "</span>";
    }
}

/**
 * generate not boolean column for datatable
 * @param $column
 * @return string
 */
function getNotBooleanColumn($column, $attributeName)
{
    if (isset($column)) {
        if ($column[$attributeName]) {
            return "<span class='badge badge-danger'>" . trans('lang.yes') . "</span>";
        } else {
            return "<span class='badge badge-success'>" . trans('lang.no') . "</span>";
        }
    }
}

/**
 * generate order payment column for datatable
 * @param $column
 * @return string
 */
function getPayment($column, $attributeName)
{
    if (isset($column) && $column[$attributeName]) {
        return "<span class='badge badge-success'>" . $column[$attributeName] . "</span> ";
    } else {
        return "<span class='badge badge-danger'>" . trans('lang.order_not_paid') . "</span>";
    }
}

/**
 * @param array $array
 * @param $baseUrl
 * @param string $idAttribute
 * @param string $titleAttribute
 * @return string
 */
function getLinksColumn($array = [], $baseUrl, $idAttribute = 'id', $titleAttribute = 'title')
{
    $html = '<a href="${href}" class="text-bold text-dark">${title}</a>';
    $result = [];
    foreach ($array as $link) {
        $replace = preg_replace('/\$\{href\}/', url($baseUrl, $link[$idAttribute]), $html);
        $replace = preg_replace('/\$\{title\}/', $link[$titleAttribute], $replace);
        $result[] = $replace;
    }
    return implode(', ', $result);
}

/**
 * @param array $column
 * @param string $attributeName
 * @param string $routeName
 * @return string
 */
function getRouteColumn($column, $attributeName, $routeName)
{
    return getRouteColumnWithName($column, $attributeName, $routeName, $column[$attributeName]);
}

/**
 * @param array $column
 * @param string $attributeName
 * @param string $routeName
 * @param string $displayName
 * @return string
 */
function getRouteColumnWithName($column, $attributeName, $routeName, $displayName)
{
    $html = '<a href="'.route($routeName, $column['id']).'" class="text-bold routeLink">'.$displayName.'</a>';
    return $html;
}

/**
 * @param array $column
 * @param string $attributeName
 * @param string $routeName
 * @param string $displayName
 * @return string
 */
function getRouteColumnAnotherName($column, $attributeName, $routeName)
{
    $html = '<a href="'.route($routeName, $column[$attributeName]).'" class="text-bold routeLink">'.$column[$attributeName].'</a>';
    return $html;
}

/**
 * generate boolean for string
 * string value= Y, N
 * @param $string
 * @return bool
 */
function transStringToBoolean($string)
{
    if (isset($string)) {
        $string=strtoupper($string);
        if(strpos($string, "Y") !== false){
            return true;
        }
        else{
            return false;
        }
    }
}

/**
 * @param array $array
 * @param $routeName
 * @param string $idAttribute
 * @param string $titleAttribute
 * @return string
 */
function getLinksColumnByRouteName($array = [], $routeName, $idAttribute = 'id', $titleAttribute = 'title')
{
    $html = '<a href="${href}" class="text-bold text-dark">${title}</a>';
    $result = [];
    foreach ($array as $link) {
        $replace = preg_replace('/\$\{href\}/', route($routeName, $link[$idAttribute]), $html);
        $replace = preg_replace('/\$\{title\}/', $link[$titleAttribute], $replace);
        $result[] = $replace;
    }
    return implode(', ', $result);
}

function getArrayColumn($array = [], $titleAttribute = 'title', $optionClass = '', $separator = ', ')
{
    $result = [];
    foreach ($array as $link) {
        $title = $link[$titleAttribute];
//        $replace = preg_replace('/\$\{href\}/', url($baseUrl, $link[$idAttribute]), $html);
//        $replace = preg_replace('/\$\{title\}/', $link[$titleAttribute], $replace);
        $html = "<span class='{$optionClass}'>{$title}</span>";
        $result[] = $html;
    }
    return implode($separator, $result);
}

function getEmailColumn($column, $attributeName)
{
    if (isset($column)) {
        if ($column[$attributeName]) {
            return "<a class='btn btn-outline-secondary btn-sm' href='mailto:" . $column[$attributeName] . "'><i class='fa fa-envelope mr-1'></i>" . $column[$attributeName] . "</a>";
        } else {
            return '';
        }
    }
}


/**
 * get check box column
 */
function getButtonColumn($column, $checkboxName, $id, $data=[])
{
    if (isset($column)){
        if (count($data)>0){
            $extradata="";
            foreach($data as $d)  {
                $extradata.=$d." ";
            }
        }
        if ($column['id']) {
            return "<div class='checkbox icheck'>
                        <label class='w-auto ml-3 form-check-inline'>
                            <div class= 'btn btn-".setting('theme_color')."' onClick='selectUserList(this)' data-extra='".$extradata."' value='".$column[$id]."' id='$column[$id]' name='".$checkboxName."' '>
                                <i class='fa fa-plus'></i>
                            </div>
                        </label>
                    </div>";
        } 
    }else {
        return '';
    }
}

/**
 * get new random number
 */
function RandomNumberGenerator( $length=12 ){

    $counter = ceil($length/4);
    // 0보다 작으면 안된다.
    $counter = $counter > 0 ? $counter : 1;            

    $charList = array( 
                    array("0", "1", "2", "3", "4", "5","6", "7", "8", "9", "0"),
                    array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"),
                    array("!", "@", "#", "%", "^", "&", "*") 
                );
    $number = "";
    for($i = 0; $i < $counter; $i++)
    {
        $strArr = array();
        for($j = 0; $j < count($charList); $j++)
        {
            $list = $charList[$j];

            $char = $list[array_rand($list)];
            $pattern = '/^[a-z]$/';
            // a-z 일 경우에는 새로운 문자를 하나 선택 후 배열에 넣는다.
            if( preg_match($pattern, $char) ) array_push($strArr, strtoupper($list[array_rand($list)]));
            array_push($strArr, $char);
        } 
        // 배열의 순서를 바꿔준다.
        shuffle( $strArr );

        // number에 붙인다.
        for($j = 0; $j < count($strArr); $j++) $number .= $strArr[$j];
    }
    // 길이 조정
    return substr($number, 0, $length);
}

/**
 * @param int $user_id
 * @param string $token
 * @return boolean
 */
function isEmailExpired($email, $token){
    $users = DB::table('email_history')->where('email', $email)
    ->whereNull('read_at')->where('expired_at', '>=', \Carbon\Carbon::now())->get();
    foreach($users as $user){
        if(Hash::check($token, $user->token)){
            DB::table('email_history')
            ->where('id', $user->id)
            ->update(['read_at' => \Carbon\Carbon::now()]);
            return $user->user_id;
        }
    }
    return null;
}

/**
 * @param int $user_id
 * @param string $password
 * @return boolean
 */
function changePassword($user_id, $password){
    try{
        $users = DB::table('users')->where('id', $user_id)
        ->update(['password' => Hash::make($password)],
                ['updated_at' => \Carbon\Carbon::now()]);
    }
    catch(Exception $e){
        throw $e;
    }
}

/**
 * get available languages on the application
 */
function getAvailableLanguages()
{
    $dir = base_path('resources/lang');
    $languages = array_diff(scandir($dir), array('..', '.'));
    $languages = array_map(function ($value) {
        return ['id' => $value, 'value' => trans('lang.app_setting_' . $value)];
    }, $languages);

    return array_column($languages, 'value', 'id');
}

/**
 * get all languages
 */

function getLanguages()
{

    return array(
        'aa' => 'Afar',
        'ab' => 'Abkhaz',
        'ae' => 'Avestan',
        'af' => 'Afrikaans',
        'ak' => 'Akan',
        'am' => 'Amharic',
        'an' => 'Aragonese',
        'ar' => 'Arabic',
        'as' => 'Assamese',
        'av' => 'Avaric',
        'ay' => 'Aymara',
        'az' => 'Azerbaijani',
        'ba' => 'Bashkir',
        'be' => 'Belarusian',
        'bg' => 'Bulgarian',
        'bh' => 'Bihari',
        'bi' => 'Bislama',
        'bm' => 'Bambara',
        'bn' => 'Bengali',
        'bo' => 'Tibetan Standard, Tibetan, Central',
        'br' => 'Breton',
        'bs' => 'Bosnian',
        'ca' => 'Catalan; Valencian',
        'ce' => 'Chechen',
        'ch' => 'Chamorro',
        'co' => 'Corsican',
        'cr' => 'Cree',
        'cs' => 'Czech',
        'cu' => 'Old Church Slavonic, Church Slavic, Church Slavonic, Old Bulgarian, Old Slavonic',
        'cv' => 'Chuvash',
        'cy' => 'Welsh',
        'da' => 'Danish',
        'de' => 'German',
        'dv' => 'Divehi; Dhivehi; Maldivian;',
        'dz' => 'Dzongkha',
        'ee' => 'Ewe',
        'el' => 'Greek, Modern',
        'en' => 'English',
        'eo' => 'Esperanto',
        'es' => 'Spanish; Castilian',
        'et' => 'Estonian',
        'eu' => 'Basque',
        'fa' => 'Persian',
        'ff' => 'Fula; Fulah; Pulaar; Pular',
        'fi' => 'Finnish',
        'fj' => 'Fijian',
        'fo' => 'Faroese',
        'fr' => 'French',
        'fy' => 'Western Frisian',
        'ga' => 'Irish',
        'gd' => 'Scottish Gaelic; Gaelic',
        'gl' => 'Galician',
        'gn' => 'GuaranÃƒÂ­',
        'gu' => 'Gujarati',
        'gv' => 'Manx',
        'ha' => 'Hausa',
        'he' => 'Hebrew (modern)',
        'hi' => 'Hindi',
        'ho' => 'Hiri Motu',
        'hr' => 'Croatian',
        'ht' => 'Haitian; Haitian Creole',
        'hu' => 'Hungarian',
        'hy' => 'Armenian',
        'hz' => 'Herero',
        'ia' => 'Interlingua',
        'id' => 'Indonesian',
        'ie' => 'Interlingue',
        'ig' => 'Igbo',
        'ii' => 'Nuosu',
        'ik' => 'Inupiaq',
        'io' => 'Ido',
        'is' => 'Icelandic',
        'it' => 'Italian',
        'iu' => 'Inuktitut',
        'ja' => 'Japanese (ja)',
        'jv' => 'Javanese (jv)',
        'ka' => 'Georgian',
        'kg' => 'Kongo',
        'ki' => 'Kikuyu, Gikuyu',
        'kj' => 'Kwanyama, Kuanyama',
        'kk' => 'Kazakh',
        'kl' => 'Kalaallisut, Greenlandic',
        'km' => 'Khmer',
        'kn' => 'Kannada',
        'ko' => 'Korean',
        'kr' => 'Kanuri',
        'ks' => 'Kashmiri',
        'ku' => 'Kurdish',
        'kv' => 'Komi',
        'kw' => 'Cornish',
        'ky' => 'Kirghiz, Kyrgyz',
        'la' => 'Latin',
        'lb' => 'Luxembourgish, Letzeburgesch',
        'lg' => 'Luganda',
        'li' => 'Limburgish, Limburgan, Limburger',
        'ln' => 'Lingala',
        'lo' => 'Lao',
        'lt' => 'Lithuanian',
        'lu' => 'Luba-Katanga',
        'lv' => 'Latvian',
        'mg' => 'Malagasy',
        'mh' => 'Marshallese',
        'mi' => 'Maori',
        'mk' => 'Macedonian',
        'ml' => 'Malayalam',
        'mn' => 'Mongolian',
        'mr' => 'Marathi (Mara?hi)',
        'ms' => 'Malay',
        'mt' => 'Maltese',
        'my' => 'Burmese',
        'na' => 'Nauru',
        'nb' => 'Norwegian BokmÃƒÂ¥l',
        'nd' => 'North Ndebele',
        'ne' => 'Nepali',
        'ng' => 'Ndonga',
        'nl' => 'Dutch',
        'nn' => 'Norwegian Nynorsk',
        'no' => 'Norwegian',
        'nr' => 'South Ndebele',
        'nv' => 'Navajo, Navaho',
        'ny' => 'Chichewa; Chewa; Nyanja',
        'oc' => 'Occitan',
        'oj' => 'Ojibwe, Ojibwa',
        'om' => 'Oromo',
        'or' => 'Oriya',
        'os' => 'Ossetian, Ossetic',
        'pa' => 'Panjabi, Punjabi',
        'pi' => 'Pali',
        'pl' => 'Polish',
        'ps' => 'Pashto, Pushto',
        'pt' => 'Portuguese',
        'qu' => 'Quechua',
        'rm' => 'Romansh',
        'rn' => 'Kirundi',
        'ro' => 'Romanian, Moldavian, Moldovan',
        'ru' => 'Russian',
        'rw' => 'Kinyarwanda',
        'sa' => 'Sanskrit (Sa?sk?ta)',
        'sc' => 'Sardinian',
        'sd' => 'Sindhi',
        'se' => 'Northern Sami',
        'sg' => 'Sango',
        'si' => 'Sinhala, Sinhalese',
        'sk' => 'Slovak',
        'sl' => 'Slovene',
        'sm' => 'Samoan',
        'sn' => 'Shona',
        'so' => 'Somali',
        'sq' => 'Albanian',
        'sr' => 'Serbian',
        'ss' => 'Swati',
        'st' => 'Southern Sotho',
        'su' => 'Sundanese',
        'sv' => 'Swedish',
        'sw' => 'Swahili',
        'ta' => 'Tamil',
        'te' => 'Telugu',
        'tg' => 'Tajik',
        'th' => 'Thai',
        'ti' => 'Tigrinya',
        'tk' => 'Turkmen',
        'tl' => 'Tagalog',
        'tn' => 'Tswana',
        'to' => 'Tonga (Tonga Islands)',
        'tr' => 'Turkish',
        'ts' => 'Tsonga',
        'tt' => 'Tatar',
        'tw' => 'Twi',
        'ty' => 'Tahitian',
        'ug' => 'Uighur, Uyghur',
        'uk' => 'Ukrainian',
        'ur' => 'Urdu',
        'uz' => 'Uzbek',
        've' => 'Venda',
        'vi' => 'Vietnamese',
        'vo' => 'VolapÃƒÂ¼k',
        'wa' => 'Walloon',
        'wo' => 'Wolof',
        'xh' => 'Xhosa',
        'yi' => 'Yiddish',
        'yo' => 'Yoruba',
        'za' => 'Zhuang, Chuang',
        'zh' => 'Chinese',
        'zu' => 'Zulu',
    );

}

function generateCustomField($fields, $fieldsValues = null)
{
    $htmlFields = [];
    $startSeparator = '<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">';
    $endSeparator = '</div>';
    foreach ($fields as $field) {
        $dynamicVars = [
            '$RANDOM_VARIABLE$' => 'var' . time() . rand() . 'ble',
            '$FIELD_NAME$' => $field->name,
            '$DISABLED$' => $field->disabled === true ? '"disabled" => "disabled",' : '',
            '$REQUIRED$' => $field->required === true ? '"required" => "required",' : '',
            '$MODEL_NAME_SNAKE$' => getOnlyClassName($field->custom_field_model),
            '$FIELD_VALUE$' => 'null',
            '$INPUT_ARR_SELECTED$' => '[]',

        ];
        $gf = new GeneratorField();
        if ($fieldsValues) {
            foreach ($fieldsValues as $value) {
                if ($field->id === $value->customField->id) {
                    $dynamicVars['$INPUT_ARR_SELECTED$'] = $value->value ? $value->value: '[]';
                    $dynamicVars['$FIELD_VALUE$'] = '\'' . addslashes($value->value) . '\'';
                    $gf->validations[] = $value->value;
                    continue;
                }
            }
        }
        // dd($gf->validations);
        $gf->htmlType = $field['type'];
        $gf->htmlValues = $field['values'];
        $gf->dbInput = '';
        if ($field['type'] === 'selects') {
            $gf->htmlType = 'select';
            $gf->dbInput = 'hidden,mtm';
        }
        $fieldTemplate = HTMLFieldGenerator::generateCustomFieldHTML($gf, config('infyom.laravel_generator.templates', 'adminlte-templates'));


        if (!empty($fieldTemplate)) {
            foreach ($dynamicVars as $variable => $value) {
                $fieldTemplate = str_replace($variable, $value, $fieldTemplate);
            }
            $htmlFields[] = $fieldTemplate;
        }
//    dd($fieldTemplate);
    }
    foreach ($htmlFields as $index => $field) {
        if (round(count($htmlFields) / 2) == $index + 1) {
            $htmlFields[$index] = $htmlFields[$index] . "\n" . $endSeparator . "\n" . $startSeparator;
        }
    }
    $htmlFieldsString = implode("\n\n", $htmlFields);
    $htmlFieldsString = $startSeparator . "\n" . $htmlFieldsString . "\n" . $endSeparator;
//    dd($htmlFieldsString);
    $renderedHtml = "";
    try {
        $renderedHtml = render(Blade::compileString($htmlFieldsString));
//        dd($renderedHtml);
    } catch (FatalThrowableError $e) {
    }
    return $renderedHtml;
}

/**
 * render php code in string give with compiling data
 *
 * @param $__php
 * @param null $__data
 * @return string
 * @throws FatalThrowableError
 */
function render($__php, $__data = null)
{
    $obLevel = ob_get_level();
    ob_start();
    if ($__data) {
        optionct($__data, EXTR_SKIP);
    }
    try {
        eval('?>' . $__php);
    } catch (Exception $e) {
        while (ob_get_level() > $obLevel) ob_end_clean();
        throw $e;
    } catch (Throwable $e) {
        while (ob_get_level() > $obLevel) ob_end_clean();
        throw new FatalThrowableError($e);
    }
    return ob_get_clean();
}

/**
 * get custom field value from custom fields collection given
 * @param null $customFields
 * @param $request
 * @return array
 */
function getCustomFieldsValues($customFields = null, $request = null)
{

    if (!$customFields) {
        return [];
    }
    if (!$request) {
        return [];
    }
    $customFieldsValues = [];
    foreach ($customFields as $cf) {
        $value = $request->input($cf->name);
        $view = $value;
        $fieldType = $cf->type;
        if ($fieldType === 'selects') {
            $view = GeneratorFieldsInputUtil::prepareKeyValueArrFromLabelValueStr($cf->values);
            $view = array_filter($view, function ($v) use ($value) {
                return in_array($v, $value);
            });
            $view = implode(', ', array_flip($view));
            $value = json_encode($value);
        } elseif ($fieldType === 'select' || $fieldType === 'radio') {
            $view = GeneratorFieldsInputUtil::prepareKeyValueArrFromLabelValueStr($cf->values);
            $view = array_flip($view)[$value];
        } elseif ($fieldType === 'boolean') {
            $view = getBooleanColumn(['0' => $view], '0');

        } elseif ($fieldType === 'password') {
            $view = str_repeat('•', strlen($value));
            $value = bcrypt($value);
        } elseif ($fieldType === 'date') {
            $view = getDateColumn(['date' => $view], 'date');
        } elseif ($fieldType === 'email') {
            $view = getEmailColumn(['email' => $view], 'email');
        } elseif ($fieldType === 'textarea') {
            $view = strip_tags($view);
        }


        $customFieldsValues[] = [
            'custom_field_id' => $cf->id,
            'value' => $value,
            'view' => $view
        ];
    }

    return $customFieldsValues;
}


/**
 * convert an array to assoc array using one attribute in the array
 * 0 => [
 *      name => 'The_Name'
 *      title => 'TITLE'
 * ]
 *
 * to
 *
 * The_Name => [
 *      name => 'The_Name'
 *      title => 'TITLE'
 * ]
 */
function convertToAssoc($collection, $key)
{
    $newCollection = [];
    foreach ($collection as $c) {
        $newCollection[$c[$key]] = $c;
    }
    return $newCollection;
}

/**
 * Get class name by giving the full name of th class
 * Ex:
 * $fullClassName = App\Models\UserModel
 * $isSnake = true
 * return
 * user_model
 * $fullClassName = App\Models\UserModel
 * $isSnake = false
 * return
 * UserModel
 * @param $fullClassName
 * @param bool $isSnake
 * @return mixed|string
 */
function getOnlyClassName($fullClassName, $isSnake = true)
{
    $modelNames = preg_split('/\\\\/', $fullClassName);
    if ($isSnake) {
        return snake_case(end($modelNames));
    }
    return end($modelNames);

}

function getModelsClasses(string $dir, array $excepts = null)
{
    if ($excepts === null) {
        $excepts = [
            'App\Models\Upload',
            'App\Models\CustomField',
            'App\Models\Media',
            'App\Models\CustomFieldValue',
        ];
    }
    $customFieldModels = array();
    $cdir = scandir($dir);
    foreach ($cdir as $key => $value) {
        if (!in_array($value, array(".", ".."))) {
            if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                $customFieldModels[$value] = getModelsClasses($dir . DIRECTORY_SEPARATOR . $value);
            } else {
                $fullClassName = "App\\Models\\" . basename($value, '.php');
                if (!in_array($fullClassName, $excepts)) {
                    $customFieldModels[$fullClassName] = trans('lang.' . snake_case(basename($value, '.php')) . '_plural');
                }

            }
        }
    }
    return $customFieldModels;
}

function getNeededArray($delimiter = '|', $string = '', $input)
{
    $array = explode($delimiter, $string, 2);
    if (count($array) === 1) {
        return [$array[0] => $input];
    } else {
        return [$array[0] => getNeededArray($delimiter, $array[1], $input)];
    }
}