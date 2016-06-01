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

use UIoT\App\Core\Communication\Parsers\Treaters\ResourceData;
use UIoT\App\Core\Communication\Requesting\RaiseRequest;
use UIoT\App\Core\Communication\Requesting\RequestParser;
use UIoT\App\Data\Models\Parsers\ResourceObject;
use UIoT\App\Data\Singletons\RequestSingleton;
use UIoT\App\Helpers\Manipulation\Strings;
use UIoT\App\Helpers\Visual\Menu;

/**
 * Class ResourceMenu
 * @package UIoT\App\Core\Communication\Parsers\Handlers
 */
class ResourceMenu extends RequestSingleton
{
    /**
     * Create a Resource Menu
     *
     * @param mixed $data
     * @return void
     */
    public function parse($data)
    {
        $menu = new Menu();

        $reqData = RequestParser::parseData(ResourceData::getInstance(),
            RaiseRequest::get('resources'));

        foreach ($reqData->getData() as $item) {
            /** @var $item ResourceObject */
            $menu->addItem('/' . Strings::toLower($item->RSRC_NAME),
                Strings::toCamel($item->RSRC_FRIENDLY_NAME, true));
        }

        RequestParser::setCustomResponse($this, $menu->showContent(), true);
    }
}
