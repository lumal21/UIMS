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
 * @copyright University of Brasília
 */

namespace UIoT\App\Core\Helpers\Manipulators;

/**
 * Class Urls
 * @package UIoT\App\Core\Helpers\Manipulators
 */
final class Urls
{
    private static $layouts = [], $resources = [], $query_string = [], $url = [];

    /**
     * Register Layouts
     */
    static function registerItems()
    {
        /* set predefined layouts */
        self::setLayouts(json_decode(PREDEFINED_LAYOUTS));

        /* set predefined resource types */
        self::setResources(json_decode(RESOURCE_TYPES));
    }

    /**
     * Set Resources
     *
     * @param array $resources
     */
    public static function setResources($resources)
    {
        self::$resources = $resources;
    }

    /**
     * Makes a Big Check
     *
     * @return mixed
     */
    static function getResourceControllerInUrl()
    {
        /* set variables */
        $c = ((self::getControllerInUrl() == self::getUrlReverseCombination()['layout']) ? (self::getControllerInUrl()) : (self::getUrlReverseCombination()['layout']));
        $a = self::getActionInUrl();

        /* @todo improve this check */
        /* giant check */
        return (($c != DEFAULT_CONTROLLER) ? (((!in_array($a, self::getResources()) && ($a == $c))) ? ($a) : ((($a == $c) || ($a != DEFAULT_VIEW_ACTION)) ? $c : $a)) : ($c));
    }

    /**
     * Get Controller in Url
     *
     * @return mixed
     */
    static function getControllerInUrl()
    {
        return ((!empty($k = @self::combineUrl()[0])) ? $k : DEFAULT_CONTROLLER);
    }

    /**
     * Return Final Url Array
     *
     * @return array
     */
    static function combineUrl()
    {
        return array_values(array_diff_assoc(...self::$url));
    }

    /**
     * Get Url Reverse Combination
     *
     * @return array
     */
    static function getUrlReverseCombination()
    {
        return ['layout' => reset(self::getLayoutCombination()), 'resource' => reset(self::getResourceCombination())];
    }

    /**
     * Get Layout Combination
     *
     * @return array
     */
    static function getLayoutCombination()
    {
        return array_filter(self::combineUrl(), 'self::combinationTest');
    }

    /**
     * Get Resource Combination
     *
     * @return array
     */
    static function getResourceCombination()
    {
        return array_filter(self::combineUrl(), 'self::combinationTestTwo');
    }

    /**
     * Get Action In the Url
     *
     * @return mixed
     */
    static function getActionInUrl()
    {
        return ((!empty($k = @self::combineUrl()[1])) ? $k : DEFAULT_VIEW_ACTION);
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
     * Return Array without Controller Name
     *
     * @return array
     */
    static function combineUrlSimple()
    {
        /* create array */
        $a = self::combineUrl();

        /* unset controller */
        unset($a[0]);

        /* return array */
        return $a;
    }

    /**
     * Get Template Url
     *
     * @return string
     */
    static function getValidTemplateUrl()
    {
        return strstr(implode('/', self::combineUrl()), (self::getControllerInUrl() . '/' . self::getActionInUrl()));
    }

    /**
     * Set the Query String
     *
     * @return array
     */
    static function setQueryString()
    {
        return (self::$query_string = json_decode(QUERY_STRING));
    }

    /**
     * Check Combination Validation
     *
     * @return bool
     */
    static function checkCombination()
    {
        /* get combination */
        $g = self::getUrlCombination();

        /* return if is resource or not */
        return (!empty($g['layout']) && !empty($g['resource']));
    }

    /**
     * Get Url Combination
     *
     * @return array
     */
    static function getUrlCombination()
    {
        return ['layout' => reset(array_reverse(self::getLayoutCombination())), 'resource' => reset(self::getResourceCombination())];
    }

    /**
     * Get Final Combination
     *
     * @return string
     */
    static function getFinalCombination()
    {
        return implode('/', self::getUrlCombination());
    }

    /**
     * Get Resource Final Url
     *
     * @return string
     */
    static function getValidResourceUrl()
    {
        return strstr(implode('/', self::combineUrl()), self::getFinalTwoCombination());
    }

    /**
     * Get Final Resource Combination
     *
     * @return mixed
     */
    static function getFinalTwoCombination()
    {
        return self::getUrlCombination()['resource'];
    }

    /**
     * Get Query String
     *
     * @return mixed
     */
    public static function getQueryString()
    {
        return self::$query_string;
    }

    /**
     * Add Url
     *
     * @param $url_string
     */
    static function addUrl($url_string = '')
    {
        self::$url[] = array_filter(explode('/', $url_string), 'strlen');
    }

    /**
     * Set Url
     *
     * @return array
     */
    static function getUrl()
    {
        return self::$url;
    }

    /**
     * Combination test
     * Phase 1
     *
     * @param $x
     * @return bool
     */
    private static function combinationTest($x)
    {
        return (array_search($x, self::getLayouts()) != false);
    }

    /**
     * Get Layouts
     *
     * @return mixed
     */
    static function getLayouts()
    {
        return self::$layouts;
    }

    /**
     * Set Layouts
     *
     * @param mixed $layouts
     */
    static function setLayouts($layouts)
    {
        self::$layouts = $layouts;
    }

    /**
     * Combination test
     * Phase 2
     *
     * @param $x
     * @return mixed
     */
    private static function combinationTestTwo($x)
    {
        return (array_search($x, self::getResources()) != false);
    }
}