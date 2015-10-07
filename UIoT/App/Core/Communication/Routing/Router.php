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

namespace UIoT\App\Core\Communication\Routing;

use UIoT\App\Core\Communication\Sessions\Indexer;
use UIoT\App\Core\Helpers\Manipulators\Arrays;
use UIoT\App\Core\Helpers\Manipulators\Urls;
use UIoT\App\Core\Renders\Resource;
use UIoT\App\Core\Renders\Template;

/**
 * Class Router
 * @property mixed resource_url
 * @property mixed controller
 * @property mixed action
 * @package UIoT\App\Core\Communication\Routing
 */
final class Router
{
    /**
     * Start's Router Procedure
     */
    public function __construct()
    {
        /* map section */
        $this->reach();

        /* routing section */
        $this->route();
        $this->query();

        /* show section */
        $this->open();
    }

    /**
     * Route the Items
     *
     * @return bool
     */
    private function route()
    {
        /* get controller name (layout) */
        $this->controller   = Indexer::updateKeyIfNeeded('controller_router', Urls::getController());
        $this->action       = Indexer::updateKeyIfNeeded('action_router', Urls::getActionInUrl());
        $this->resource_url = Indexer::updateKeyIfNeeded('resource_router', Urls::getValidResourceUrl());

        return true;
    }

    /**
     * Open the Template or Router
     */
    private function open()
    {
        echo((Urls::checkCombination()) ? Selector::select(Selector::instantiate(new Resource(['controller' => $this->controller, 'file' => $this->resource_url]))) : Selector::select(Selector::instantiate(new Template(['controller' => $this->controller, 'action' => $this->action]))));
    }

    /**
     * Get Requested URL and Script Name, Removing the Repeated Things
     */
    private function reach()
    {
        /* register layouts and resources */
        Urls::registerItems();

        /* add urls */
        Urls::addUrl(REQUEST_URL);
        Urls::addUrl(PHP_SELF);
        Urls::addUrl(QUERY_STRING);
    }

    /**
     * Apply Query String
     */
    private function query()
    {
        /* first $last need be empty */
        $last = '';

        /* put query string into $GET */
        foreach (Urls::combineUrlSimple() as $key => $value) {
            ((($key % 2) != 0) ? (Arrays::addOnArray($last = $value, '', $_GET)) : Arrays::addOnArray($last, urldecode($value), $_GET));
        }

        return true;
    }
}