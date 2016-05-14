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

namespace UIoT\App\Data\Controllers;

use UIoT\App\Core\Communication\Parsers\Treaters\ResourceDataTreater;
use UIoT\App\Core\Communication\Requesting\RaiseRequestManager;
use UIoT\App\Core\Communication\Requesting\RequestParserMethods;
use UIoT\App\Core\Controllers\Register;
use UIoT\App\Data\Singletons\ControllerSingleton;
use UIoT\App\Helpers\Visual\Menu;

/**
 * Class Home
 * @package UIoT\App\Data\Controllers
 */
final class Home extends ControllerSingleton
{
    /**
     * This is an Example and Beta Code!
     *
     * @return string|null
     */
    public function actionMain()
    {
        $menuContent = new Menu();

        $requestDataTreater = RequestParserMethods::parseRequestWithResponse(ResourceDataTreater::getInstance(),
            RaiseRequestManager::doGetRequest('/resources'));

        if (RequestParserMethods::getJobStatus($requestDataTreater))
            return '';

        foreach ($requestDataTreater->getResponse() as $resourceItem) {
            $menuContent->addItem($resourceItem->NAME);
        }

        Register::addVariable('{{menu_content}}', $menuContent->showContent());
        return '';
    }
}
