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
use UIoT\App\Core\Communication\Requesting\RequestParser;
use UIoT\App\Data\Models\Parsers\PropertyObject;
use UIoT\App\Data\Singletons\RequestSingleton;

/**
 * Class ResourceProperties
 * @package UIoT\App\Core\Communication\Parsers\Treaters
 */
class ResourceProperties extends RequestSingleton
{
    /**
     * @var RequestSingleton
     */
    protected static $requestInstance = null;

    /**
     * Parse Request Data or Do Request
     *
     * @param mixed $data
     * @return void
     */
    public function parse($data)
    {
        if (is_object($data)) {
            RequestParser::parseRequest(ResourceObject::getInstance(), $this, $data);
        } elseif (is_array($data)) {
            RequestParser::setCustomData($this, (new JsonMapper())->mapArray($data, array(), new PropertyObject));
        }
    }
}
