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

use UIoT\App\Core\Communication\Parsers\DataHandler;
use UIoT\App\Core\Communication\Parsers\DataTreater;
use UIoT\App\Core\Communication\Parsers\Handlers\DataTableHandler;
use UIoT\App\Core\Communication\Parsers\Treaters\ResourceIdTreater;
use UIoT\App\Core\Communication\Parsers\Treaters\ResourcePropertiesTreater;
use UIoT\App\Core\Communication\Requesting\Raise;
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
     * @param mixed $resourceName
     * @return void
     */
    public function parse($resourceName)
    {
        $resourceIdTreater = DataTreater::parseTreater(ResourceIdTreater::getInstance(),
            Raise::doRequest('resources?name=' . $resourceName));

        if (DataTreater::getTreaterStatus($resourceIdTreater, $this)) {
            return;
        }

        $resourcePropertiesTreater = DataTreater::parseTreater(ResourcePropertiesTreater::getInstance(),
            Raise::doRequest('properties?rsrc_id=' . $resourceIdTreater->getResponse()));

        if (DataTreater::getTreaterStatus($resourcePropertiesTreater, $this)) {
            return;
        }

        DataHandler::setHandlerResponse(DataTableHandler::getInstance(), $this,
            ['keys' => $resourcePropertiesTreater->getResponse(), 'values' => Raise::doRequest($resourceName)]);
    }
}
