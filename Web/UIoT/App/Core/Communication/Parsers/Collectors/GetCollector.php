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
use UIoT\App\Core\Communication\Parsers\Handlers\DataTableHandler;
use UIoT\App\Core\Communication\Requesting\RaiseRequestManager;
use UIoT\App\Core\Communication\Requesting\RequestParserMethods;
use UIoT\App\Data\Singletons\RequestSingleton;

/**
 * Class GetCollector
 * @package UIoT\App\Core\Communication\Parsers\Collectors
 */
class GetCollector extends RequestSingleton
{
    /**
     * @var RequestSingleton
     */
    protected static $requestInstance = null;

    /**
     * Parse Request Data or Do Request
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     *
     * @param array $resourceData
     * @return void
     */
    public function parse($resourceData)
    {
        $getMethod = (new Get)->setInput($this)->setResponse($resourceData);

        if (RequestParserMethods::getJobStatusWithResponse($getMethod->getResponse(), $this))
            return;

        RequestParserMethods::parseResponseWithRequestStatus(DataTableHandler::getInstance(), $this, [
            'resource' => $resourceData['name'], 'keys' => $getMethod->getResponse()->getData(),
            'values' => RaiseRequestManager::doGetRequest($resourceData['name'])]);
    }
}
