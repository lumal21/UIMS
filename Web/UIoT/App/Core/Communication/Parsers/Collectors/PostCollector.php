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

use UIoT\App\Core\Communication\Parsers\DataCollector;
use UIoT\App\Core\Communication\Parsers\DataHandler;
use UIoT\App\Core\Communication\Parsers\DataTreater;
use UIoT\App\Core\Communication\Parsers\Handlers\EmptyHtmlFormHandler;
use UIoT\App\Core\Communication\Parsers\Treaters\ResourceIdTreater;
use UIoT\App\Core\Communication\Parsers\Treaters\ResourcePropertiesTreater;
use UIoT\App\Core\Communication\Requesting\RaiseRequestManager;
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
        $resourceIdTreater = DataTreater::parseTreater(ResourceIdTreater::getInstance(),
            RaiseRequestManager::doGetRequest('resources?name=' . $resourceData['name']));

        if(DataCollector::getCollectorStatus($resourceIdTreater, $this)) {
            return;
        }

        $resourcePropertiesTreater = DataTreater::parseTreater(ResourcePropertiesTreater::getInstance(),
            RaiseRequestManager::doGetRequest('properties?resource_id=' . $resourceIdTreater->getResponse()));

        DataHandler::setHandlerResponseStatus(EmptyHtmlFormHandler::getInstance(), $this, [
            'resource' => $resourceData['name'],
            'keys' => $resourcePropertiesTreater->getResponse(),
            'arguments' => $resourceData['arguments']]);
    }
}
