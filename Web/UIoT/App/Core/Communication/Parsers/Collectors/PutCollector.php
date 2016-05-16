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

use UIoT\App\Core\Communication\Parsers\Handlers\FilledFormHandler;
use UIoT\App\Core\Communication\Parsers\Treaters\ResourceIdTreater;
use UIoT\App\Core\Communication\Parsers\Treaters\ResourcePropertiesTreater;
use UIoT\App\Core\Communication\Parsers\Treaters\SpecificResourceItemTreater;
use UIoT\App\Core\Communication\Requesting\RaiseRequestManager;
use UIoT\App\Core\Communication\Requesting\RequestParserMethods;
use UIoT\App\Data\Singletons\RequestSingleton;
use UIoT\App\Helpers\Manipulation\Constants;

/**
 * Class PutCollector
 * @package UIoT\App\Core\Communication\Parsers\Collectors
 */
class PutCollector extends RequestSingleton
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
        $resourceIdTreater = RequestParserMethods::parseRequest(ResourceIdTreater::getInstance(),
            RaiseRequestManager::doGetRequest('resources?name=' . $resourceData['name']));

        if (RequestParserMethods::getJobStatusWithResponse($resourceIdTreater, $this))
            return;

        $resourcePropertiesTreater = RequestParserMethods::parseRequest(ResourcePropertiesTreater::getInstance(),
            RaiseRequestManager::doGetRequest('properties?resource_id=' . $resourceIdTreater->getResponse()));

        RaiseRequestManager::doPutRequest(Constants::returnConstant('QUERY_STRING'));
        RaiseRequestManager::doGetRequest("{$resourceData['name']}" . Constants::returnConstant('QUERY_STRING'));

        $specificItemTreater = RequestParserMethods::parseRequest(SpecificResourceItemTreater::getInstance(),
            RaiseRequestManager::doGetRequest("{$resourceData['name']}?{$resourceData['arguments'][2]}={$resourceData['arguments'][3]}"));

        if (RequestParserMethods::getJobStatusWithResponse($specificItemTreater, $this))
            return;

        RequestParserMethods::parseResponseWithRequestStatus(FilledFormHandler::getInstance(), $this, [
            'resource' => $resourceData['name'], 'keys' => $resourcePropertiesTreater->getResponse(),
            'values' => $specificItemTreater->getResponse(), 'arguments' => $resourceData['arguments']]);
    }
}
