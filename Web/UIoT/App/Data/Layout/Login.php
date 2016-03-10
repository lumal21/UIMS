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

namespace UIoT\App\Data\Layout;

use UIoT\App\Core\Controllers\Commander;
use UIoT\App\Core\Helpers\Visual\Pages;
use UIoT\App\Core\Resources\Indexer as ResourceIndexer;
use UIoT\App\Core\Templates\Indexer as TemplateIndexer;
use UIoT\App\Data\Singletons\LayoutSingleton;

/**
 * Class Login
 *
 * @package UIoT\App\Data\Layout
 */
class Login extends LayoutSingleton
{
    /**
     *
     * Set Resources
     */
    public function __resources()
    {
        ResourceIndexer::addAsset('Background', 'Default', 'Images/6.jpg');
        ResourceIndexer::addAsset('Logo', 'Default', 'Images/Logo_small_transparent.png');

        ResourceIndexer::addAsset('FoundationOld', 'Default', 'Stylesheet/Foundation.old.css');
        ResourceIndexer::addAsset('MainStyle', 'Default', 'Stylesheet/Styles.css');
        ResourceIndexer::addAsset('Foundation', 'Vendor', 'Bower/Foundation-sites/Dist/Foundation.css');
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
        TemplateIndexer::addVariable('{{resource_content}}', Commander::getControllerContent());
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
