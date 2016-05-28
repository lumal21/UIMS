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

namespace UIoT\App\Core\Communication\Parsers\Collectors;

use UIoT\App\Core\Communication\Methods\Get;
use UIoT\App\Core\Communication\Methods\Post;
use UIoT\App\Core\Communication\Parsers\Handlers\EmptyHtmlFormHandler;
use UIoT\App\Core\Communication\Requesting\RequestParserMethods;
use UIoT\App\Data\Singletons\RequestSingleton;

/**
 * Class PostCollector
 * @package UIoT\App\Core\Communication\Parsers\Collectors
 */
class PostCollector extends RequestSingleton
{
    /**
     * @var RequestSingleton
     */
    protected static $requestInstance = null;

    /**
     * Parse Request Data or Do Request
     *
     * @param array $resourceData
     * @return void
     */
    public function parse($resourceData)
    {
        $getMethod = (new Get)->setReceivedCollector($this)->setResponseCollector($resourceData);
        $postMethod = (new Post)->setReceivedCollector($this)->setResponseCollector($resourceData);

        if (RequestParserMethods::getJobStatusWithResponse($postMethod->getResponseCollector(), $this))
            return;

        RequestParserMethods::parseResponseWithRequestStatus(EmptyHtmlFormHandler::getInstance(), $this, [
            'resource' => $resourceData['name'], 'keys' => $getMethod->getResponseCollector()->getResponse()]);
    }
}
