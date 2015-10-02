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
        /** request url area */

        /* @todo improve these code */
        /* @todo make the code dynamic */

        /* register layouts and resources */
        Urls::registerItems();

        /* set query string */
        Urls::setQueryString();

        /* add urls */
        Urls::addUrl(explode('/', REQUEST_URL));
        Urls::addUrl(explode('/', PHP_SELF));
    }

    /**
     * Apply Request Url's for Resources
     */
    private function __applyResource()
    {
        /* @todo improve these code */
        /* @todo make the code dynamic */

        /* get controller name (layout) */
        $this->controller   = Urls::getResourceControllerInUrl();
        $this->resource_url = Urls::getValidResourceUrl();

        return true;
    }

    /**
     * Apply Request Url's for Templates
     */
    private function __applyTemplate()
    {
        /* @todo improve these code */
        /* @todo make the code dynamic */

        /* apply controller and action */
        $this->controller = Urls::getControllerInUrl();
        $this->action     = Urls::getActionInUrl();

        /* add query string as url */
        Urls::addUrl(Urls::getQueryString());

        /* set query string as combine url */
        $this->query_string = Urls::combineUrl();

        /* check existence of query_string */
        $aka = ($this->query_string[sizeof($this->query_string) - 1]);

        /* foreach query string */
        if (strpos($aka, '?') !== false):
            $c = explode('?', $aka);
            unset($c[0]);
            $this->query_string[sizeof($this->query_string) - 1] = $c[0];
            $this->query_string[]                                = implode('&', $c);
        endif;

        /* unset first item */
        unset($this->query_string[0]);

        /* if errors happens */
        $last = '';

        /* put query string into $GET */
        foreach ($this->query_string as $key => $value)
            if (($key % 2) != 0)
                $_GET[$last = $value] = '';
            else
                $_GET[$last] = urldecode($value);

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