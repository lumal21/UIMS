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

use UIoT\App\Core\Assets\Register as AssetIndexer;
use UIoT\App\Core\Controllers\Register as TemplateIndexer;
use UIoT\App\Core\Resources\Render;
use UIoT\App\Data\Singletons\LayoutSingleton;
use UIoT\App\Helpers\Visual\Pages;

/**
 * Class Main
 *
 * @package UIoT\App\Data\Layouts
 */
class Main extends LayoutSingleton
{
    /**
     *
     * Set Resources
     */
    public function __resources()
    {
        AssetIndexer::addAsset('Background', 'Default', 'Images/6.jpg');
        AssetIndexer::addAsset('Logo', 'Default', 'Images/Logo_small_transparent.png');

        AssetIndexer::addAsset('FoundationOld', 'Default', 'Stylesheet/Foundation.old.css');
        AssetIndexer::addAsset('MainStyle', 'Default', 'Stylesheet/Styles.css');
        AssetIndexer::addAsset('MainMainStyle', 'Main', 'Stylesheet/Main.css');
        AssetIndexer::addAsset('Foundation', 'Vendor', 'Bower/Foundation-sites/Dist/Foundation.css');

        AssetIndexer::addAsset('Jquery', 'Vendor', 'Bower/Jquery/Dist/Jquery.js');
        AssetIndexer::addAsset('FoundationJs', 'Vendor', 'Bower/Foundation-sites/Dist/Foundation.min.js');
        AssetIndexer::addAsset('FoundationCore', 'Vendor', 'Bower/Foundation-sites/Js/Foundation.core.js');
        AssetIndexer::addAsset('FoundationCanvas', 'Vendor', 'Bower/Foundation-sites/Js/Foundation.offcanvas.js');
        AssetIndexer::addAsset('FoundationTriggers', 'Vendor', 'Bower/Foundation-sites/Js/Foundation.util.triggers.js');
        AssetIndexer::addAsset('FoundationMotion', 'Vendor', 'Bower/Foundation-sites/Js/Foundation.util.motion.js');
    }

    /**
     *
     * Set Configuration
     */
    public function __configuration()
    {
        Pages::setTitle('Welcome to UIoT');
    }

    /**
     *
     * Set Templates
     */
    public function __templates()
    {
        TemplateIndexer::setTemplateFolder('Main');
        TemplateIndexer::addVariable('{{resource_content}}', Render::getControllerData());
        TemplateIndexer::addTemplate('Layouts/Main.php');
    }

    /**
     *
     * Return Template Code
     *
     * @return null|mixed|string
     */
    public function __show()
    {
        return TemplateIndexer::returnTemplates();
    }
}
