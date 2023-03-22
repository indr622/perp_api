<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

namespace App\Util;


class UrlHelper
{
    public static $instance;

    private $url;

    private $urlSegmented;

    public function __construct()
    {
        self::$instance = $this;
    }

    public static function get()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function setUrl($url)
    {
        $this->url = $url;

        $this->urlSegmented =  explode('/', $this->removeProtocols($this->url));
    }

    public function getSegment($segment = 1, $beautify = false)
    {
        return ($beautify) ? ucwords($this->urlSegmented[$segment]) : $this->urlSegmented[$segment];
    }

    public function getAllSegmentsFormatted($separator = '::')
    {
        $segmented = $this->urlSegmented;

        array_shift($segmented);

        $formatted = '';

        foreach ($segmented as $s) {
            $formatted .= ' ' . $separator . ' ' . ucwords($s);
        }

        return $formatted;
    }

    public function returnActiveIf($match, $segment)
    {
        $segmented = $this->urlSegmented;

        array_shift($segmented);

        if (!isset($segmented[$segment])) return '';

        return ($match == $segmented[$segment]) ? 'active' : '';
    }

    protected function removeProtocols($url)
    {
        return str_replace(['http://', 'https://'], '', $url);
    }
}
