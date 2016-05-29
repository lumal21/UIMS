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

namespace UIoT\App\Core\Communication\Parsers\Handlers;

use UIoT\App\Core\Communication\Parsers\Treaters\ResourceDataTreater;
use UIoT\App\Core\Communication\Requesting\RaiseRequestManager;
use UIoT\App\Core\Communication\Requesting\RequestParserMethods;
use UIoT\App\Data\Models\Parsers\ResourceObject;
use UIoT\App\Data\Singletons\RequestSingleton;
use UIoT\App\Helpers\Manipulation\Strings;
use UIoT\App\Helpers\Visual\Menu;

/**
 * Class ResourcesMenuHandler
 * @package UIoT\App\Core\Communication\Parsers\Handlers
 */
class ResourcesMenuHandler extends RequestSingleton
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
        $menuContent = new Menu();

        $requestDataTreater = RequestParserMethods::parseRequestWithResponse(ResourceDataTreater::getInstance(),
            RaiseRequestManager::doGetRequest('resources'));

        foreach ($requestDataTreater->getData() as $resourceItem) {
            /** @var $resourceItem ResourceObject */
            $menuContent->addItem('/' . Strings::toLower($resourceItem->RSRC_NAME), Strings::toCamel($resourceItem->RSRC_FRIENDLY_NAME, true));
        }

        RequestParserMethods::setCustomResponseDataWithStatus($this, $menuContent->showContent(), true);
    }
}
