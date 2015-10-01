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

namespace UIoT\App\Classes\Communication\Parsers;

use Httpful\Mime;
use UIoT\App\Classes\Communication\Requesting\Brain;
use UIoT\App\Classes\Helpers\Strings;

/**
 * Class DataManager
 * @package UIoT\App\Classes\Communication\Parsers
 */
final class DataManager
{
    private static $controller, $action;

    /**
     *
     */
    function __construct()
    {
        /* start collectors and handlers */
        (new DataCollector);
        (new DataHandler);

        /* store final handler */
        DataHandler::storeHandler();
    }

    /**
     * Prepare Brain Template
     */
    static function prepareTemplate()
    {
        Brain::__setTemplate(DataHandler::getParserMethod(self::getAction()), Mime::JSON);
    }

    /**
     * Return DataHandler and DataCollector Instance
     *
     * @param $method
     * @return $this
     */
    static function getInstance($method)
    {
        return DataCollector::initCollector(DataHandler::getParserCollector($method), DataHandler::getParserHandler($method));
    }

    /**
     * This must only be called for REST Purposes!
     * Because the controller NAME will be lowercase, and the Engine need in Ucfirst!
     * Only for REST need be lowercase.
     *
     * @return mixed
     */
    public static function getController()
    {
        return Strings::toRestUrlName(self::$controller);
    }

    /**
     * Set controller name only for REST purposes
     *
     * @param mixed $controller
     * @return string
     */
    public static function setController($controller = '')
    {
        return (self::$controller = Strings::toControllerName($controller));
    }

    /**
     * @return mixed
     */
    public static function getAction()
    {
        return Strings::toRestUrlName(self::$action);
    }

    /**
     * @param mixed $action
     * @return string
     */
    public static function setAction($action)
    {
        return (self::$action = Strings::toActionName($action));
    }
}