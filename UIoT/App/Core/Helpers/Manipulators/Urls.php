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
final class Urls
{
    /**
     * @var array
     */
    private static $layouts = [];
    /**
     * @var array
     */
    private static $resources = [];
    /**
     * @var array
     */
    private static $url = [];
    /**
     * @var array
     */
    private static $combined_url;
    /**
     * @var array
     */
    private static $combinations;
    /**
     * @var array
     */
    private static $reversed_f;
    /**
     * @var array
     */
    private static $normal_f;

    /**
     * @observation Code was Rearranged..
     * @observation Because that the Sections are incorrect.
     */

    /*
     * Section Register Items
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

    /*
     * Section Getters
     */

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
     * Set Url
     *
     * @return array
     */
    public static function getUrl()
    {
        return self::$url;
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

    /*
     * Section Setters
     */

    /**
     * Get Url Reverse Combination
     *
     * @return array
     */
    public static function getReversedUrlCombination()
    {
        /* only to refer as reference */
        $i = array_reverse(self::getLayoutCombination());
        $k = self::getResourceCombination();

        return Indexer::updateKeyIfNeeded('reverse_combination_url_router', ((!is_array(self::getReversedF())) ? (self::setReversedF(['layout' => reset($i), 'resource' => reset($k)])) : (self::getReversedF())));
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
     * Get Combinations
     *
     * @return array
     */
    public static function getCombinations()
    {
        return self::$combinations;
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
     * @param mixed $reversed_f
     * @return mixed
     */
    public static function setReversedF($reversed_f)
    {
        return (self::$reversed_f = $reversed_f);
    }

    /*
     * Section Get Parts
     */

    /**
     * Makes a Big Check
     * And returns the Valid Controller Name in a Resource Request
     *
     * @return mixed
     */
    private static function getResourceControllerInUrl()
    {
        /* set variables */
        $c = ['controller' => ((self::getControllerInUrl() == self::getUrlCombination()['layout']) ? (self::getControllerInUrl()) : (self::getUrlCombination()['layout'])), 'action' => (self::getActionInUrl())];

        /* @todo improve this check */
        /* giant check */
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

    /*
     * Section Get Urls Combinations
     */

    /**
     * Get Url Combination
     *
     * @return array
     */
    public static function getUrlCombination()
    {
        /* only for pass reference */
        $i = self::getLayoutCombination();
        $k = self::getResourceCombination();

        return Indexer::updateKeyIfNeeded('combination_url_router', ((!is_array(self::getNormalF())) ? (self::setNormalF(['layout' => reset($i), 'resource' => reset($k)])) : (self::getNormalF())));
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

    /*
     * Section Get Parts Combinations
     */

    /**
     * Set Url Combination
     *
     * @param array $normal_f
     * @return mixed
     */
    public static function setNormalF($normal_f)
    {
        return (self::$normal_f = $normal_f);
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

    /*
     * Section Combination Tests
     */

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

    /*
     * Section Combine Urls
     */

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
    private static function combinationTest($x)
    {
        return (array_search($x, self::getLayouts()) !== false);
    }

    /*
     * Section get Resources Urls
     */

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

    /*
     * Section Misc
     */

    /**
     * Combination test
     * Phase 2
     *
     * @param array $x
     * @return boolean
     */
    private static function combinationTestTwo($x)
    {
        return (array_search($x, self::getResources()) !== false);
    }
}