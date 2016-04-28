<?php

/**
 * UIoTuims
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
 * @app UIoT User-Friendly Management System
 * @author UIoT
 * @developer Claudio Santoro
 * @developer Igor Moraes
 * @copyright University of Brasília
 */

namespace UIoT\App\Exception;

use Exception;
use UIoT\App\Security\Manager as SecurityHandler;

/**
 * Class Manager
 * Exception Manager
 *
 * @package UIoT\App\Exception
 */
final class Manager
{
    /**
     * Create Instance of Everything
     *
     * Manager constructor.
     */
    public function __construct()
    {
        Register::instantiateMembers();

        Register::configureMembers();

        Register::invokeMembers();
    }

    /**
     *
     * Create a Message for Whoops
     * Is a function to create a custom message, without stack trace.
     *
     * @param int $code
     * @param string $title
     * @param string $message_title
     * @param array $message
     * @param bool $security_error
     *
     * @throws Exception
     */
    public static function throwError($code = 1, $title = '', $message_title = '', $message = [], $security_error = false)
    {
        /* check if you have valid access */
        !$security_error || SecurityHandler::checkIpAddressAuthority();

        /* add data table */
        Register::getHandler()->addDataTable($message_title, $message);

        /* handle exception - need to be $this to don't make a infinite recursive loop */
        Register::getRunner()->handleException(new Exception($title, $code));
    }
}
