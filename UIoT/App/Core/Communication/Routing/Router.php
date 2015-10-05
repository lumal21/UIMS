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

namespace UIoT\App\Core\Communication\Routing;

use UIoT\App\Core\Communication\Sessions\Indexer;
use UIoT\App\Core\Helpers\Manipulators\Arrays;
use UIoT\App\Core\Helpers\Manipulators\Urls;
use UIoT\App\Core\Renders\Resource;
use UIoT\App\Core\Renders\Template;

/**
 * Class Router
 * @property string controller
 * @property string action
 * @property string sub_action
 * @property array $query_string
 * @property array base_folder
 * @property string request_bas
 * @property array request_urs
 * @property string resource_url
 * @property array query_array
 * @package UIoT\App\Core\Communication\Routing
 */
final class Router
{
    /**
     * Start's Router Procedure
     */
    function __construct()
    {
        $this->__map();
        $this->__chose();
        $this->__show();
    }

    /**
     * Choose Resource or Template
     */
    private function __chose()
    {
        (($this->__check()) ? $this->__applyResource() : $this->__applyTemplate());
    }

    /**
     * Echoes the Rendered Code
     */
    private function __show()
    {
        echo($this->__router());
    }

    /**
     * Get Requested URL and Script Name, Removing the Repeated Things
     */
    private function __map()
    {
        /* register layouts and resources */
        Urls::registerItems();

        /* add urls */
        Urls::addUrl(REQUEST_URL);
        Urls::addUrl(PHP_SELF);
        Urls::addUrl(QUERY_STRING);
    }

    /**
     * Apply Request Url's for Resources
     */
    private function __applyResource()
    {
        /* get controller name (layout) */
        $this->controller   = Indexer::updateKeyIfNeeded('controller_router', Urls::getResourceControllerInUrl());
        $this->resource_url = Indexer::updateKeyIfNeeded('resource_router', Urls::getValidResourceUrl());

        return true;
    }

    /**
     * Apply Request Url's for Templates
     */
    private function __applyTemplate()
    {
        /* apply controller and action */
        $this->controller = Indexer::updateKeyIfNeeded('controller_router', Urls::getControllerInUrl());
        $this->action     = Indexer::updateKeyIfNeeded('action_router', Urls::getActionInUrl());

        /* first $last need be empty */
        $last = '';

        /* put query string into $GET */
        foreach (Urls::combineUrlSimple() as $key => $value)
            ((($key % 2) != 0) ? (Arrays::addOnArray($last = $value, '', $_GET)) : Arrays::addOnArray($last, urldecode($value), $_GET));

        return true;
    }

    /**
     * Check if is Resource or Not
     *
     * @return bool
     */
    private function __check()
    {
        return (Urls::checkCombination());
    }

    /**
     * Do the Routing
     *
     * @return Resource|Template
     */
    private function __router()
    {
        return (($this->__check()) ? new Resource($this->controller, $this->resource_url) : new Template($this->controller, $this->action));
    }
}