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

use JsonMapper;
use UIoT\App\Core\Communication\Requesting\RequestParserMethods;
use UIoT\App\Data\Models\Parsers\PropertyObject;
use UIoT\App\Data\Singletons\RequestSingleton;

/**
 * Class ResourcePropertiesTreater
 * @package UIoT\App\Core\Communication\Parsers\Treaters
 */
class ResourcePropertiesTreater extends RequestSingleton
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
            RequestParserMethods::parseResponseWithRequestStatus(ResourceObjectTreater::getInstance(), $this, $requestContent);
        } elseif (is_array($requestContent)) {
            RequestParserMethods::setCustomResponseData($this, (new JsonMapper())->mapArray($requestContent, array(), new PropertyObject));
        }
    }
}
