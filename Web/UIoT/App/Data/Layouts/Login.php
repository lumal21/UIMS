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
use UIoT\App\Core\Controllers\Render;
use UIoT\App\Data\Singletons\LayoutSingleton;
use UIoT\App\Helpers\Visual\Pages;

/**
 * Class Login
 *
 * @package UIoT\App\Data\Layouts
 */
class Login extends LayoutSingleton
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
        AssetIndexer::addAsset('Foundation', 'Vendor', 'Bower/Foundation-sites/Dist/Foundation.css');
    }

    /**
     *
     * Set Configuration
     */
    public function __configuration()
    {
        Pages::setTitle('Login at UIoT');
    }

    /**
     *
     * Set Templates
     */
    public function __templates()
    {
        TemplateIndexer::setTemplateFolder('Login');
        TemplateIndexer::addVariable('{{resource_content}}', Render::getControllerData());
        TemplateIndexer::addTemplate('Layouts/Login.php');
    }

    /**
     *
     * Return Template
     *
     * @return null|mixed|string
     */
    public function __show()
    {
        return TemplateIndexer::returnTemplates();
    }
}
