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

namespace UIoT\App\Data\Layouts;

use UIoT\App\Core\Communication\Parsers\Handlers\ResourcesMenuHandler;
use UIoT\App\Core\Communication\Requesting\RequestParserMethods;
use UIoT\App\Core\Resources\Render;
use UIoT\App\Helpers\Visual\Pages;

/**
 * Class Add
 * @package UIoT\App\Data\Layouts
 */
class Add extends Main
{
    /**
     * Set Configuration
     */
    public function configureLayout()
    {
        Pages::setTitle('UIoT - Add Resource');
    }

    /**
     * Set Templates
     */
    public function setTemplates()
    {
        $this->getTemplateFactory()->setTemplateFolder('Main');
        $this->getTemplateFactory()->addVariable('{{resource_content}}', Render::getControllerData());
        $this->getTemplateFactory()->addVariable('{{menu_content}}',
            RequestParserMethods::parseRequest(ResourcesMenuHandler::getInstance())->getData());
        $this->getTemplateFactory()->addTemplate('Layouts/Main.php');
    }

    /**
     * Return Template Code
     *
     * @return null|mixed|string
     */
    public function showLayout()
    {
        return $this->getTemplateFactory()->returnTemplates();
    }
}
