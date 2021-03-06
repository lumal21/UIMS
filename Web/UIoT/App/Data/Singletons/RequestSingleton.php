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

namespace UIoT\App\Data\Singletons;

use UIoT\App\Core\Settings\Register;
use UIoT\App\Data\Models\Requesting\RequestModel;

/**
 * Class RequestSingleton
 * @package UIoT\App\Data\Singletons
 */
class RequestSingleton extends RequestModel
{
    /**
     * Return Instance of Controller
     *
     * @return RequestSingleton
     */
    public static function getInstance()
    {
        static $instance = null;

        if (null === $instance) {
            $instance = new static;
        }

        return $instance;
    }

    /**
     * Return RAISe Token
     *
     * @return string
     */
    public function getToken()
    {
        return Register::get('raise')->raiseToken;
    }
}
