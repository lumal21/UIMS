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
use UIoT\App\Core\Controllers\Register as TemplateIndexer;
use UIoT\App\Core\Resources\Render;
use UIoT\App\Data\Singletons\LayoutSingleton;
use UIoT\App\Helpers\Visual\Pages;

/**
 * Class Edit
 * @package UIoT\App\Data\Layouts
 */
class Edit extends LayoutSingleton
{
    /**
     * Set Resources
     */
    public function getResources()
    {
        $this->getAssetManager()->addAsset('Background', 'Default', 'Images/6.jpg');
        $this->getAssetManager()->addAsset('Logo', 'Default', 'Images/Logo_small_transparent.png');

        $this->getAssetManager()->addAsset('FoundationOld', 'Default', 'Stylesheet/Foundation.old.css');
        $this->getAssetManager()->addAsset('MainStyle', 'Default', 'Stylesheet/Styles.css');
        $this->getAssetManager()->addAsset('MainMainStyle', 'Main', 'Stylesheet/Main.css');
        $this->getAssetManager()->addAsset('Foundation', 'Vendor', 'Bower/Foundation-sites/Dist/Foundation.css');

        $this->getAssetManager()->addAsset('Jquery', 'Vendor', 'Bower/Jquery/Dist/Jquery.js');
        $this->getAssetManager()->addAsset('FoundationJs', 'Vendor', 'Bower/Foundation-sites/Dist/Foundation.min.js');
        $this->getAssetManager()->addAsset('FoundationCore', 'Vendor', 'Bower/Foundation-sites/Js/Foundation.core.js');
        $this->getAssetManager()->addAsset('FoundationCanvas', 'Vendor', 'Bower/Foundation-sites/Js/Foundation.offcanvas.js');
        $this->getAssetManager()->addAsset('FoundationTriggers', 'Vendor', 'Bower/Foundation-sites/Js/Foundation.util.triggers.js');
        $this->getAssetManager()->addAsset('FoundationMotion', 'Vendor', 'Bower/Foundation-sites/Js/Foundation.util.motion.js');
    }

    /**
     * Set Configuration
     */
    public function configureLayout()
    {
        Pages::setTitle('UIoT - Edit Resource');
    }

    /**
     * Set Templates
     */
    public function setTemplates()
    {
        TemplateIndexer::setTemplateFolder('Main');
        TemplateIndexer::addVariable('{{resource_content}}', Render::getControllerData());
        TemplateIndexer::addVariable('{{menu_content}}', RequestParserMethods::parseRequest(ResourcesMenuHandler::getInstance())->getData());
        TemplateIndexer::addTemplate('Layouts/Main.php');
    }

    /**
     * Return Template Code
     *
     * @return null|mixed|string
     */
    public function showLayout()
    {
        return TemplateIndexer::returnTemplates();
    }
}
