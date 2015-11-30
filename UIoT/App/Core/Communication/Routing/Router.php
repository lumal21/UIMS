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
use UIoT\App\Core\Helpers\Manipulators\Constants;
use UIoT\App\Core\Helpers\Manipulators\Urls;
use UIoT\App\Core\Helpers\Methods\Get as GetHelper;
use UIoT\App\Core\Helpers\Methods\Post as PostHelper;
use UIoT\App\Core\Resources\Render as ResourceRender;
use UIoT\App\Core\Templates\Render as TemplateRender;

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
        $this->controller = Indexer::updateKeyIfNeeded('controller_router', Urls::getController());
        $this->action = Indexer::updateKeyIfNeeded('action_router', Urls::getActionInUrl());
        $this->resource_url = Indexer::updateKeyIfNeeded('resource_router', Urls::getValidResourceUrl());

        return true;
    }

    /**
     * Open the Template or Router
     */
    private function open()
    {
        echo Urls::checkCombination() ? Selector::select(Selector::instantiate(new ResourceRender(['controller' => $this->controller, 'file' => $this->resource_url]))) : Selector::select(Selector::instantiate(new TemplateRender(['controller' => $this->controller, 'action' => $this->action])));
    }

    /**
     * Get Requested URL and Script Name, Removing the Repeated Things
     */
    private function reach()
    {
        /* register layouts and resources */
        Urls::registerItems();

        /* add urls */
        Urls::addUrl(Constants::returnConstant('REQUEST_URL'));
        Urls::addUrl(Constants::returnConstant('PHP_SELF'));
        Urls::addUrl(Constants::returnConstant('QUERY_STRING'));
    }

    /**
     * Apply Query String
     */
    private function query()
    {
        /* apply get data from query string */
        GetHelper::storeGetData(GetHelper::receiveGetData());

        /* store post data */
        PostHelper::storePostData(PostHelper::receivePostData());

        return true;
    }
}