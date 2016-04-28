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

use stdClass;
use UIoT\App\Core\Communication\Parsers\Handlers\RaiseCodeMessageHandler;
use UIoT\App\Data\Singletons\RequestSingleton;

/**
 * Class ResourceObjectTreater
 * @package UIoT\App\Core\Communication\Parsers\Treaters
 */
class ResourceObjectTreater extends RequestSingleton
{
    /**
     * @var RequestSingleton
     */
    protected static $requestInstance = null;

    /**
     * Parse Request Data or Do Request
     *
     * @param mixed $requestContent
     * @return void
     */
    public function parse($requestContent)
    {
        if (is_object($requestContent)) {
            if (!property_exists($requestContent, 'code') || !property_exists($requestContent, 'message')) {
                $requestContent = new stdClass();
                $requestContent->code = '503';
                $requestContent->message = 'Raise answered an unknown message.';
            }

            $raiseCodeHandler = RaiseCodeMessageHandler::getInstance();
            $raiseCodeHandler->parse($requestContent);
            $this->setResponse($raiseCodeHandler->getResponse());
            $this->setDone($raiseCodeHandler->getDone());
            return;
        }
    }
}
