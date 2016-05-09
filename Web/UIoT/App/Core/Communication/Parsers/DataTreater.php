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

namespace UIoT\App\Core\Communication\Parsers;

use stdClass;
use UIoT\App\Data\Singletons\RequestSingleton;

/**
 * Class DataTreater
 * @package UIoT\App\Core\Communication\Parsers
 */
class DataTreater
{
    /**
     * Check a treater status and set his response
     *
     * @param RequestSingleton $requestedTreater selected Treater
     * @param RequestSingleton $responseTreater response Collector
     * @return bool if need stop the execution
     */
    public static function setTreaterStatus(RequestSingleton $requestedTreater, RequestSingleton $responseTreater)
    {
        $responseTreater->setResponse($requestedTreater->getResponse());
        return $responseTreater->setDone($requestedTreater->getDone());
    }

    /**
     * Parse Treater and return it
     *
     * @param RequestSingleton $treater selected Treater
     * @param mixed $arguments Treater arguments
     * @return RequestSingleton the same Treater
     */
    public static function parseTreater(RequestSingleton $treater, $arguments)
    {
        $treater->parse($arguments);
        return $treater;
    }

    /**
     * Set Response Code for Treaters
     *
     * @param RequestSingleton $treater
     * @param mixed $requestedContent
     * @param array $arguments
     */
    public static function setResponseCode(RequestSingleton $treater, $requestedContent, $arguments = [])
    {
        if(!property_exists($requestedContent, 'code') || !property_exists($requestedContent, 'message')) {
            $requestedContent = new stdClass();
            $requestedContent->code = $arguments['code'];
            $requestedContent->message = $arguments['message'];
        }

        $treater->setResponse($requestedContent);
    }
}
