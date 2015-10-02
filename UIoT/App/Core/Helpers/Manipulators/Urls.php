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
 * Class Urls
 * @package UIoT\App\Core\Helpers\Manipulators
 */
final class Urls
{
    /**
     * @var
     */
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
     * @param array $resources
     */
    public static function setResources($resources)
    {
        self::$resources = $resources;
    }

    /**
     * @return mixed
     */
    static function getResourceControllerInUrl()
    {
        return ((self::getControllerInUrl() != DEFAULT_CONTROLLER) ? ((!in_array(self::getActionInUrl(), self::getResources())) ? (self::getActionInUrl()) : (self::getControllerInUrl())) : (self::getControllerInUrl()));
    }

    /**
     * @return mixed
     */
    static function getControllerInUrl()
    {
        return ((!empty($k = @self::combineUrl()[0])) ? $k : DEFAULT_CONTROLLER);
    }

    /**
     * @return array
     */
    static function combineUrl()
    {
        return array_values(array_diff_assoc(...self::$url));
    }

    /**
     * @return mixed
     */
    static function getActionInUrl()
    {
        return ((!empty($k = @self::combineUrl()[1])) ? $k : DEFAULT_VIEW_ACTION);
    }

    /**
     * @return array
     */
    public static function getResources()
    {
        return self::$resources;
    }

    /**
     * @return string
     */
    static function getValidTemplateUrl()
    {
        return strstr(implode('/', self::combineUrl()), (self::getControllerInUrl() . '/' . self::getActionInUrl()));
    }

    /**
     * @return array
     */
    static function setQueryString()
    {
        return (self::$query_string = explode('/', json_decode(QUERY_STRING)));
    }

    /**
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
     * @return array
     */
    static function getUrlCombination()
    {
        return ['layout' => reset(array_reverse(self::getLayoutCombination())), 'resource' => reset(self::getResourceCombination())];
    }

    /**
     * @return array
     */
    static function getLayoutCombination()
    {
        return array_filter(self::combineUrl(), 'self::combinationTest');
    }

    /**
     * @return array
     */
    static function getResourceCombination()
    {
        return array_filter(self::combineUrl(), 'self::combinationTestTwo');
    }

    /**
     * @return string
     */
    static function getFinalCombination()
    {
        return implode('/', self::getUrlCombination());
    }

    /**
     * @return string
     */
    static function getValidResourceUrl()
    {
        return strstr(implode('/', self::combineUrl()), self::getFinalTwoCombination());
    }

    static function getFinalTwoCombination()
    {
        return self::getUrlCombination()['resource'];
    }

    /**
     * @return array
     */
    static function getUrlReverseCombination()
    {
        return ['layout' => reset(self::getLayoutCombination()), 'resource' => reset(self::getResourceCombination())];
    }

    /**
     * @return mixed
     */
    public static function getQueryString()
    {
        return self::$query_string;
    }

    /**
     * @param $url
     */
    static function addUrl($url = [])
    {
        self::$url[] = array_filter($url, 'strlen');
    }

    /**
     * @return array
     */
    static function getUrl()
    {
        return self::$url;
    }

    /**
     * @param $x
     * @return bool
     */
    private static function combinationTest($x)
    {
        return (array_search($x, self::getLayouts()) != false);
    }

    /**
     * @return mixed
     */
    static function getLayouts()
    {
        return self::$layouts;
    }

    /**
     * @param mixed $layouts
     */
    static function setLayouts($layouts)
    {
        self::$layouts = $layouts;
    }

    /**
     * @param $x
     * @return mixed
     */
    private static function combinationTestTwo($x)
    {
        return (array_search($x, self::getResources()) != false);
    }
}