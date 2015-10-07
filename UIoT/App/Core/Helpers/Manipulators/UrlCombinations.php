<?php

/**
 * UIoT CMS
 * @version dev-alpha
 *                          88
 *                          ""              ,d
 *                                          88
 *              88       88 88  ,adPPYba, MM88MMM
 *              88       88 88 a8"     "8a  88
 *              88       88 88 8b       d8  88
 *              "8a,   ,a88 88 "8a,   ,a8"  88,
 *               `"YbbdP'Y8 88  `"YbbdP"'   "Y888
 *
 * @project Uniform Internet of Things
 * @app UIoT Content Management System
 * @author UIoT
 * @developer Claudio Santoro
 * @copyright University of Bras�lia
 */


namespace UIoT\App\Core\Helpers\Manipulators;

/**
 * Class UrlCombinations
 * @package UIoT\App\Core\Helpers\Manipulators
 */
class UrlCombinations
{
    /**
     * @var array
     */
    protected static $layouts = [];
    /**
     * @var array
     */
    protected static $resources = [];
    /**
     * @var array
     */
    protected static $url = [];
    /**
     * @var array
     */
    protected static $combined_url;
    /**
     * @var array
     */
    protected static $combinations;
    /**
     * @var array
     */
    protected static $reversed_f;
    /**
     * @var array
     */
    protected static $normal_f;

    /**
     * Get Combined Url
     *
     * @return array
     */
    public static function getCombinedUrl()
    {
        return self::$combined_url;
    }

    /**
     * Set Combined Url
     *
     * @param array $combined_url
     * @return array
     */
    public static function setCombinedUrl($combined_url)
    {
        return (self::$combined_url = $combined_url);
    }

    /**
     * Get Combinations
     *
     * @return array
     */
    public static function getCombinations()
    {
        return self::$combinations;
    }

    /**
     * Get Layouts
     *
     * @return mixed
     */
    public static function getLayouts()
    {
        return self::$layouts;
    }

    /**
     * Set Layouts
     *
     * @param mixed $layouts
     * @return mixed
     */
    public static function setLayouts($layouts)
    {
        return (self::$layouts = $layouts);
    }

    /**
     * Get All Resources
     *
     * @return array
     */
    public static function getResources()
    {
        return self::$resources;
    }

    /**
     * Set Resources
     *
     * @param array $resources
     * @return array
     */
    public static function setResources($resources)
    {
        return (self::$resources = $resources);
    }

    /**
     * Get Url Combination
     *
     * @return mixed
     */
    public static function getNormalF()
    {
        return self::$normal_f;
    }

    /**
     * Set Url Combination
     *
     * @param array $normal_f
     * @return mixed
     */
    public static function setNormalF($normal_f = [])
    {
        return ((is_array($normal_f)) ? (self::$normal_f = $normal_f) : []);
    }

    /**
     * Get Reversed Url Combination
     *
     * @return mixed
     */
    public static function getReversedF()
    {
        return self::$reversed_f;
    }

    /**
     * Set Reversed Url Combination
     *
     * @param array $reversed_f
     * @return mixed
     */
    public static function setReversedF($reversed_f = [])
    {
        return ((is_array($reversed_f)) ? (self::$reversed_f = $reversed_f) : []);
    }

    /**
     * Set Url
     *
     * @return array
     */
    public static function getUrl()
    {
        return self::$url;
    }
}