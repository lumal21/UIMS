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

namespace UIoT\App\Core\Communication\Parsers\Treaters;

use UIoT\App\Core\Communication\Parsers\DataTreater;
use UIoT\App\Core\Communication\Parsers\Handlers\RaiseCodeMessageHandler;
use UIoT\App\Core\Communication\Requesting\RequestParserMethods;
use UIoT\App\Data\Singletons\RequestSingleton;

/**
 * Class SpecificResourceItemTreater
 * @package UIoT\App\Core\Communication\Parsers\Treaters
 */
class SpecificResourceItemTreater extends RequestSingleton
{
    /**
     * @var RequestSingleton
     */
    protected static $requestInstance = null;

    /**
     * Parse Request Data or Do Request
     *
     * @param array $requestContent
     * @return void
     */
    public function parse($requestContent)
    {
        if (is_object($requestContent)) {
            RequestParserMethods::parseResponseWithRequestStatus(RaiseCodeMessageHandler::getInstance(), $this,
                DataTreater::generateResponseCode($requestContent, ['code' => '404',
                    'message' => 'The requested resource item isn\'t a registered RAISE resource item.']));
        } else {
            RequestParserMethods::setCustomResponseData($this, $requestContent);
        }
    }
}
