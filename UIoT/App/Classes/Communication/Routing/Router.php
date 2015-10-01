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

namespace UIoT\App\Classes\Communication\Routing;

use UIoT\App\Classes\Views\Resource;
use UIoT\App\Classes\Views\Template;

/**
 * Class Router
 * @property string controller
 * @property string action
 * @property string sub_action
 * @property array router_entries
 * @package UIoT\App\Classes\Communication\Routing
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

        /* get request_url and script_name */
        @$request_url = explode('/', REQUEST_URL);
        @$script_name = explode('/', SCRIPT_NAME);

        /* compare script name with request url */
        for ($i = 0; $i < sizeof($script_name); $i++) if (@$request_url[$i] == @$script_name[$i]) unset($request_url[$i]);

        /* apply array_map to lowercase and ucfirst, and array_values */
        $this->router_entries = array_map(function ($n) {
            return ucfirst(strtolower($n));
        }, array_values($request_url));
    }

    /**
     * Apply Request Url's for Resources
     */
    private function __applyResource()
    {
        /* @todo improve these code */
        /* @todo make the code dynamic */

        /* apply resources path */
        $this->controller = ((@$this->router_entries[0]) ? @$this->router_entries[0] : DEFAULT_CONTROLLER);
        $this->action     = (substr(str_replace('/' . @$this->router_entries[0], '', (str_replace((substr(SCRIPT_NAME, 1, strrpos(SCRIPT_NAME, '/'))), '', (substr(REQUEST_URL, 0, strrpos(REQUEST_URL, '/') + 1))))), 1));
        $this->sub_action = ((@$this->router_entries[(sizeof($this->router_entries) - 1)]) ? @$this->router_entries[(sizeof($this->router_entries) - 1)] : DEFAULT_VIEW_ACTION);
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
        $this->controller = ((@$this->router_entries[0]) ? @$this->router_entries[0] : DEFAULT_CONTROLLER);
        $this->action     = ((@$this->router_entries[1]) ? @$this->router_entries[1] : DEFAULT_VIEW_ACTION);

        /* check existence of query_string */
        if (strpos($aka = ($this->router_entries[sizeof($this->router_entries) - 1]), '?') !== false):
            $c                                                       = explode('?', $aka);
            $this->router_entries[sizeof($this->router_entries) - 1] = $c[0];
            unset($c[0]);
            $this->router_entries[] = implode('&', $c);
        endif;

        /* unset two first items */
        unset($this->router_entries[0]);
        unset($this->router_entries[1]);

        /* put query string into REST */
        foreach ($this->router_entries as $key => $value) if (($key % 2) == 0) $_GET[$last = $value] = ''; else $_GET[$last] = urldecode($value);

        return true;
    }

    /**
     * Check if is Resource or Not
     * @return bool
     */
    private function __check()
    {
        return (in_array(((@$this->router_entries[1]) ? @$this->router_entries[1] : ''), json_decode(RESOURCE_TYPES)));
    }

    /**
     * Do the Routing
     * @return Resource|Template
     */
    private function __router()
    {
        return (($this->__check()) ? new Resource($this->controller, $this->action, $this->sub_action) : new Template($this->controller, $this->action));
    }
}