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

use UIoT\App\Core\Communication\Sessions\Indexer;

/**
 * Class Urls
 * @package UIoT\App\Core\Helpers\Manipulators
 */
final class Urls extends UrlCombinations
{
    /**
     * @observation Code was Rearranged..
     * @observation Because that the Sections are incorrect.
     */

    /**
     * Register Items Data
     * Including Layouts and Resources
     */
    public static function registerItems()
    {
        /* set predefined layouts */
        self::setLayouts(json_decode(PREDEFINED_LAYOUTS));

        /* set predefined resource types */
        self::setResources(json_decode(RESOURCE_TYPES));
    }

    /**
     * Add Url
     *
     * @param $url_string
     */
    public static function addUrl($url_string = '')
    {
        self::$url[] = array_filter(explode('/', $url_string), 'strlen');
    }

    /**
     * @return mixed
     */
    public static function getController()
    {
        return ((self::checkCombination()) ? self::getResourceControllerInUrl() : self::getControllerInUrl());
    }

    /**
     * Check Combination Validation
     *
     * @return bool
     */
    public static function checkCombination()
    {
        return (!empty(self::getReversedUrlCombination()['layout']) && !empty(self::getReversedUrlCombination()['resource']));
    }

    /**
     * Get Url Reverse Combination
     *
     * @return array
     */
    public static function getReversedUrlCombination()
    {
        return self::getUrlCombination(true);
    }

    /**
     * Get Url Combination
     *
     * @param bool $reverse
     * @return array
     */
    public static function getUrlCombination($reverse = false)
    {
        /* only for pass reference */
        $i = (($reverse) ? array_reverse(self::getLayoutCombination()) : self::getLayoutCombination());
        $k = self::getResourceCombination();

        return Indexer::updateKeyIfNeeded('combination_url_router', ((!is_array(self::getNormalF())) ? (self::setNormalF(['layout' => reset($i), 'resource' => reset($k)])) : (self::getNormalF())));
    }

    /**
     * Get Layout Combination
     *
     * @return array
     */
    public static function getLayoutCombination()
    {
        return @(((!isset(self::getCombinations()['layout'])) && (!is_array(self::getCombinations()['layout']))) ? (self::$combinations['layout'] = (array_filter(self::combineUrl(), 'self::combinationTest'))) : (self::getCombinations()['layout']));
    }

    /**
     * Return Final Url Array
     * (Combining the Items)
     *
     * @return array
     */
    public static function combineUrl()
    {
        return ((!is_array(self::getCombinedUrl())) ? (self::setCombinedUrl(array_values(array_diff_assoc(...self::getUrl())))) : self::getCombinedUrl());
    }

    /**
     * Get Resource Combination
     *
     * @return array
     */
    public static function getResourceCombination()
    {
        return @(((!isset(self::getCombinations()['resource'])) && (!is_array(self::getCombinations()['resources']))) ? (self::$combinations['resource'] = (array_filter(self::combineUrl(), 'self::combinationTestTwo'))) : (self::getCombinations()['resource']));
    }

    /**
     * Makes a Big Check
     * And returns the Valid Controller Name in a Resource Request
     *
     * @return mixed
     */
    private static function getResourceControllerInUrl()
    {
        return self::checkResourceInto(['controller' => ((self::getControllerInUrl() == self::getUrlCombination()['layout']) ? (self::getControllerInUrl()) : (self::getUrlCombination()['layout'])), 'action' => (self::getActionInUrl())]);
    }

    /**
     * Return the Controller Url
     * For Resource
     *
     * @param $c
     * @return mixed
     */
    private static function checkResourceInto($c)
    {
        return (($c['controller'] != DEFAULT_CONTROLLER) ? (((!in_array($c['action'], self::getResources()) && ($c['action'] == $c['controller']))) ? ($c['action']) : ((($c['action'] == $c['controller']) || ($c['action'] != DEFAULT_VIEW_ACTION)) ? ($c['controller']) : ($c['action']))) : ($c['controller']));
    }

    /**
     * Get Controller in Url
     *
     * @return mixed
     */
    private static function getControllerInUrl()
    {
        return Indexer::updateKeyIfNeeded('controller_url_router', ((isset(self::combineUrl()[0])) && (!empty(self::combineUrl()[0])) ? (self::combineUrl()[0]) : DEFAULT_CONTROLLER));
    }

    /**
     * Get Action In the Url
     *
     * @return mixed
     */
    public static function getActionInUrl()
    {
        return Indexer::updateKeyIfNeeded('action_url_router', ((isset(self::combineUrl()[1])) && (!empty(self::combineUrl()[1])) ? (self::combineUrl()[1]) : DEFAULT_VIEW_ACTION));
    }

    /**
     * Get Resource Final Url
     *
     * @return string
     */
    public static function getValidResourceUrl()
    {
        return strstr(implode('/', self::combineUrl()), self::getReversedUrlCombination()['resource']);
    }

    /**
     * Combination test
     * Phase 1
     *
     * @param $x
     * @return bool
     */
    public static function combinationTest($x)
    {
        return (array_search($x, self::getLayouts()) !== false);
    }

    /**
     * Combination test
     * Phase 2
     *
     * @param array $x
     * @return boolean
     */
    public static function combinationTestTwo($x)
    {
        return (array_search($x, self::getResources()) !== false);
    }

    /**
     * Return Array without Controller Name
     * Remove the first item (Controller)
     *
     * @return array
     */
    public static function combineUrlSimple()
    {
        /* create array */
        $a = self::combineUrl();

        /* unset controller */
        unset($a[0]);

        /* return array */
        return $a;
    }
}