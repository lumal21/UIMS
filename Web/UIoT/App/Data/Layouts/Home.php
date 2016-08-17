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

use UIoT\App\Core\Communication\Parsers\Handlers\ResourceMenu;
use UIoT\App\Core\Communication\Requesting\RequestParser;
use UIoT\App\Data\Singletons\LayoutSingleton;
use UIoT\App\Helpers\Visual\Pages;

/**
 * Class Home
 * @package UIoT\App\Data\Layouts
 *
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class Home extends LayoutSingleton
{
    /**
     * Set Resources
     */
    public function getResources()
    {
        $this->getAsset()->add('Background', 'Default', 'Images/6.jpg');
        $this->getAsset()->add('Logo', 'Default', 'Images/Logo_small_transparent.png');

        $this->getAsset()->add('FoundationOld', 'Default', 'Stylesheet/Foundation.old.css');
        $this->getAsset()->add('MainStyle', 'Default', 'Stylesheet/Styles.css');
        $this->getAsset()->add('MainMainStyle', 'Main', 'Stylesheet/Main.css');
        $this->getAsset()->add('Foundation', 'Vendor', 'Bower/Foundation-sites/Dist/Foundation.css');

        $this->getAsset()->add('Jquery', 'Vendor', 'Bower/Jquery/Dist/Jquery.js');
        $this->getAsset()->add('FoundationJs', 'Vendor', 'Bower/Foundation-sites/Dist/Foundation.min.js');
        $this->getAsset()->add('FoundationCore', 'Vendor', 'Bower/Foundation-sites/Js/Foundation.core.js');
        $this->getAsset()->add('FoundationCanvas', 'Vendor', 'Bower/Foundation-sites/Js/Foundation.offcanvas.js');
        $this->getAsset()->add('FoundationAccordion', 'Vendor',
            'Bower/Foundation-sites/Dist/Js/Foundation.Accordion.js');
        $this->getAsset()->add('FoundationTriggers', 'Vendor', 'Bower/Foundation-sites/Js/Foundation.util.triggers.js');
        $this->getAsset()->add('FoundationMotion', 'Vendor', 'Bower/Foundation-sites/Js/Foundation.util.motion.js');
    }

    /**
     * Set Configuration
     */
    public function configureLayout()
    {
        Pages::setTitle('Welcome to UIoT');
    }

    /**
     * Set Templates
     */
    public function setTemplates()
    {
        $this->getTemplate()->setPath('Home');
        $this->getTemplate()->setVar('{{menu_content}}',
            RequestParser::parse(ResourceMenu::getInstance())->getData());
        $this->getTemplate()->add('Layouts/Home.php');
    }

    /**
     * Return Template Code
     *
     * @return null|mixed|string
     */
    public function showLayout()
    {
        return $this->getTemplate()->get();
    }
}
