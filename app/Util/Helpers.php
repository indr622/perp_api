<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-01
 */

namespace App\Util;

use Illuminate\Support\Facades\Log;

class Helpers
{
    /**
     *  Membantu untuk memeriksa apakah variabel yang diberikan memiliki nilai
     *
     * @param $var
     * @param string|null $default
     * @return string
     */
    public static function hasValue(&$var, $default = null)
    {
        try {

            if (!isset($var)) return $default;

            if (is_bool($var)) return $var;

            if (empty($var) || is_null($var)) return $default;

            return $var;
        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return $default;
        }
    }

    /**
     * penyortiran array multi-dimensi dengan kunci khusus
     *
     * @param $array
     * @param string $key
     * @param bool $highestFirst
     */
    public static function sort(&$array, $key = 'sort', $highestFirst = true)
    {
        usort($array, function ($a, $b) use ($key, $highestFirst) {
            return ($highestFirst) ? $b[$key] - $a[$key] : $a[$key] - $b[$key];
        });
    }

    /**
     * periksa apakah properti ada atau kembalikan nilai default jika tidak
     *
     * @param $class
     * @param $propertyName
     * @param string $default
     * @return string
     */
    public static function propertySafe(&$class, $propertyName, $default = '')
    {
        return property_exists($class, $propertyName) ? $class->{$propertyName} : $default;
    }

    /**
     * check if array key exist or return a default value if not
     *
     * @param $array
     * @param $key
     * @param string $default
     * @return string
     */
    public static function arraySafe(&$array, $key, $default = '')
    {
        return isset($array['$key']) ? $array[$key] : $default;
    }

    /**
     * periksa apakah kunci array ada atau kembalikan nilai default jika tidak
     *
     * @param $var
     * @param string $default
     * @return string
     */
    public static function trySafe(&$var, $default = '')
    {
        try {
            return $var;
        } catch (\Exception $e) {
            return $default;
        }
    }

    /**
     * format milisecond ke second
     *
     * @param $duration
     * @param int $decimal
     * @return string
     */
    public static function formatMillisecondsToSeconds($duration, $decimal = 5)
    {
        $hours = (int)($duration / 60 / 60);
        $minutes = (int)($duration / 60) - $hours * 60;
        $seconds = (float)$duration - $hours * 60 * 60 - $minutes * 60;

        return number_format($seconds, $decimal);
    }

    /**
     * pembantu untuk mengonversi kasing unta ke format tanda hubung
     *
     * @param $string
     * @param string $separator
     * @return string
     */
    public static function camel2snake($string, $separator = '_')
    {
        return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', "$1{$separator}", $string));
    }

    /**
     * pembantu untuk mengonversi tanda hubung ke case camel
     *
     * @param $string
     * @param bool $capitalizeFirstCharacter
     * @param string $separator
     * @return mixed|string
     */
    function snake2Camel($string, $capitalizeFirstCharacter = false, $separator = '_')
    {
        $str = str_replace($separator, '', ucwords($string, $separator));

        if (!$capitalizeFirstCharacter) {
            $str = lcfirst($str);
        }

        return $str;
    }

    /**
     * periksa apakah sebuah string berisi karakter atau kata tertentu
     *
     * @param string $subject
     * @param string $charOrWord
     * @return bool
     */
    public static function stringContains($subject, $charOrWord)
    {
        if (strpos($subject, $charOrWord) !== false) {
            return true;
        }
        return false;
    }

    /**
     * helper untuk mengonversi string yang dipisahkan koma menjadi array.
     * jika parameter yang diberikan string kosong, itu akan mengembalikan array kosong
     *
     * @param $string
     * @return array
     */
    public static function commasToArray(string $string): array
    {
        if ($string === "") return [];

        return explode(",", trim($string, ","));
    }

    /**
     * pembantu untuk memeriksa apakah string yang diberikan memiliki protokol web
     *
     * @param string $string
     * @return bool
     */
    public static function hasWebProtocol(string $string): bool
    {
        $d = parse_url($string);

        return !empty($d['scheme']);
    }

    /**
     * pembantu untuk membuat siput yang digantung
     *
     * @param string $string
     * @param string $sep
     * @return string
     */
    public static function stringToSlug(string $string, $sep = '-'): string
    {
        return strtolower(str_replace(['-'], $sep, static::cleanString($string)));
    }

    /**
     *bersihkan string, hapus karakter khusus
     *
     * @param string $string
     * @return string
     */
    public static function cleanString(string $string): string
    {
        $string = str_replace(' ', '-', $string); // Mengganti semua spasi dengan tanda hubung.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Menghapus karakter khusus.
        return preg_replace('/-+/', '-', $string); // Mengganti beberapa tanda hubung dengan satu tanda hubung.
    }

    /**
     * menormalkan input ke tipe array. Jika itu sebuah string, maka itu mungkin koma
     * dipisahkan nilai sehingga kami akan membuat ke array.
     *
     * @author indrabasuki <indrbasuki1@gmail.com>
     * @since  v1.0
     *
     * @param $input
     *
     * @return array
     */
    public static function normalizeToArray($input): array
    {
        if (is_array($input)) return $input;
        if (is_string($input)) return explode(',', $input);
        if (is_object($input)) return (array)$input;
        return [];
    }

    /**
     * pembantu untuk mendapatkan alamat IP Address yang sebenarnya
     *
     * @author indrabasuki <indrbasuki1@gmail.com>
     * @since  v1.0
     * @return array|false|string
     */
    public static function getClientIpAddress()
    {
        return getenv('HTTP_CLIENT_IP') ?:
            getenv('HTTP_X_FORWARDED_FOR') ?:
            getenv('HTTP_X_FORWARDED') ?:
            getenv('HTTP_FORWARDED_FOR') ?:
            getenv('HTTP_FORWARDED') ?:
            getenv('REMOTE_ADDR');
    }

    /**
     * @author indrabasuki <indrbasuki1@gmail.com>
     * @since  v1.0
     *
     * @param $key
     * @param $value
     *
     * @return bool
     */
    public static function updateEnv(string $key, string $value)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        $oldValue = env($key);
        $str = str_replace("{$key}={$oldValue}", "{$key}={$value}", $str);
        $fp = fopen($envFile, 'w');
        fwrite($fp, $str);
        fclose($fp);
        return true;
    }
}
