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

namespace UIoT\App\Exception;

use Exception;
use UIoT\App\Security\Handler as SHandler;
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
    public static $global;

    /**
     * static variable to access the Exception Handler instance
     *
     * @var Handler
     */
    public static $handler;

    /**
     * Registers Filp's Whoop's Error Handler
     *
     * @author Claudio Santoro
     */
    public function __construct()
    {
        self::$global = $this->push($this->pull('Houston, we have a problem!'));
    }

    /**
     * Pull Down!
     * This function register default Handler configuration
     *
     * @param string $title
     * @return PrettyPageHandler
     */
    private function pull($title)
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
    private function push(PrettyPageHandler $handler)
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
     * @param bool $security_error
     * @throws Exception
     */
    public function errorMessage($code = 9000, $title = '', $message_title = '', $message = [], $security_error = false)
    {
        /* @todo improve this code because isn't safe */

        /* check security things */
        if ((QUERY_STRING == 'de') && (!$security_error)) {
            SHandler::checkIpAddressAuthority();
        }

        /* check if is a valid message error code */
        $code = (((QUERY_STRING != 'de') || ($security_error)) ? (($code < 9000) ? (9000 + $code) : $code) : (($code < 9000) ? $code : (9000 - $code)));

        /* add data table */
        self::$handler->addDataTable($message_title, $message);

        /* throw a new exception */
        $this->handleException(new Exception($title, $code));
    }
}