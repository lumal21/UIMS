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

namespace UIoT\App\Exception;

use Exception;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

/**
 * Class Register
 * @package UIoT\App\Exception
 */
final class Register extends Run
{
    /**
     * static variable to access the Exception Register instance
     *
     * @var Register
     */
    static $global;

    /**
     * static variable to access the Exception Handler instance
     *
     * @var Handler
     */
    static $handler;

    /**
     * Registers Filp's Whoop's Error Handler
     *
     * @author Claudio Santoro
     */
    function __construct()
    {
        self::$global = $this->__push($this->__pull('Houston, we have a problem!'));
    }

    /**
     * Pull Down!
     * This function register default Handler configuration
     *
     * @param $title
     * @return PrettyPageHandler
     */
    private function __pull($title)
    {
        /* Is a Edited Exception Handler based on PrettyHandler */
        $handler = new Handler;

        /* add resource path from custom handler */
        $handler->addResourcePath(RESOURCE_FOLDER . 'Whoops/');

        /* set custom page title */
        $handler->setPageTitle($title);

        /* return handler */
        return $handler;
    }

    /**
     * Push Up!
     * Register the Handler to the Exception Register
     *
     * @param PrettyPageHandler $handler
     * @return $this
     */
    private function __push(PrettyPageHandler $handler)
    {
        /* set static handler instance, and push the handler */
        $this->pushHandler(self::$handler = $handler)->register();

        /* return the class instance */
        return $this;
    }

    /**
     * Create a Message for Whoops
     * Is a function to create a custom message, without stack trace.
     *
     * @param int $code
     * @param string $title
     * @param string $message_title
     * @param array $message
     * @throws \Exception
     */
    function __message($code = 9000, $title = '', $message_title = '', $message = [])
    {
        /* @todo improve this code because isn't safe */
        /* @todo put white-list-ip verification */

        /* check if is a valid message error code */
        $code = ((@$_SERVER["QUERY_STRING"] != 'de') ? (($code < 9000) ? (9000 + $code) : $code) : (($code < 9000) ? $code : (9000 - $code)));

        /* add data table */
        self::$handler->addDataTable($message_title, $message);

        /* throw a new exception */
        throw new Exception($title, $code);
    }
}