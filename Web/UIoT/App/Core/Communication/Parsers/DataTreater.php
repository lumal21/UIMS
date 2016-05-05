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

use UIoT\App\Data\Singletons\RequestSingleton;

/**
 * Class DataTreater
 * @package UIoT\App\Core\Communication\Parsers
 */
class DataTreater
{
    /**
     * Return a specific data treater
     *
     * @param RequestSingleton $requestedTreater
     * @return RequestSingleton
     */
    public static function getTreater(RequestSingleton $requestedTreater)
    {
        return $requestedTreater;
    }

    /**
     * Check a treater status and set his response
     *
     * @param RequestSingleton $checkedTreater selected Treater
     * @param RequestSingleton $responseCollector response Collector
     * @return bool if need stop the execution
     */
    public static function getTreaterStatus(RequestSingleton $checkedTreater, RequestSingleton $responseCollector)
    {
        if ($checkedTreater->getDone()) {
            $responseCollector->setResponse($checkedTreater->getResponse());

            return true;
        }

        return false;
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
}
