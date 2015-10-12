<?php

/**
 * UIoT CMS
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
 * @app UIoT Content Management System
 * @author UIoT
 * @developer Claudio Santoro
 * @copyright University of Bras�lia
 */

namespace UIoT\App\Data\Layout;

use UIoT\App\Core\Resources\Mapper;
use UIoT\App\Core\Resources\Pager;
use UIoT\App\Data\Models\Layout;

/**
 * Class Main
 * @package UIoT\App\Data\Layout
 */
class Main extends Layout
{
    /**
     * Set Resources
     * (Main)
     */
    public static function __resources()
    {
        Mapper::setResourceFolder('None');
        Mapper::addResource('Stylesheet/Styles.css', 'text/css');
        Mapper::addResource('Stylesheet/Foundation.css', 'text/css');
        Mapper::addResource('Stylesheet/Font-awesome.css', 'text/css');
        Mapper::addResource('Images/Marquee-stars.svg', 'image/svg+xml');
        Mapper::addResource('Fonts/Fontawesome-webfont.woff2', 'font/opentype');
        Mapper::addResource('Scripts/Vendor/Jquery.js', 'text/javascript');
        Mapper::addResource('Scripts/Vendor/Modernizr.js', 'text/javascript');
        Mapper::addResource('Scripts/Foundation.min.js', 'text/javascript');
        Mapper::addResource('Scripts/Foundation/Foundation.topbar.js', 'text/javascript');
        Mapper::addResource('Scripts/Foundation/Foundation.offcanvas.js', 'text/javascript');
        Mapper::setResourceFolder('Main');
        Mapper::addResource('Stylesheet/Main.css', 'text/css');
    }

    /**
     * Set Configuration
     */
    public function __configuration()
    {
        Pager::setTitle('PIKAA');
    }

    /**
     * Set Templates
     */
    public function __templates()
    {
        Mapper::setTemplateFolder('Main');
        Mapper::addTemplate('Layouts/Main.php', 'text/html');
    }

    /**
     * Return Template Code
     *
     * @return null|mixed|string
     */
    public function __show()
    {
        return Mapper::returnTemplate('Layouts/Main.html');
    }
}