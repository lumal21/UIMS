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
 * Class Login
 * @package UIoT\App\Data\Layout
 */
class Login extends Layout
{
    /**
     * Set Resources
     */
    public function __resources()
    {
        Mapper::setResourceFolder('None');
        Mapper::addResource('Images/6.jpg', 'image/jpg');
        Mapper::addResource('Images/Logo_small_transparent.png', 'image/png');
        Mapper::addResource('Stylesheet/Foundation.css', 'text/css');
        Mapper::addResource('Stylesheet/Styles.css', 'text/css');
    }

    /**
     * Set Configuration
     */
    public function __configuration()
    {
        Pager::setTitle('Hello World');
    }

    /**
     * Set Templates
     */
    public function __templates()
    {
        Mapper::setTemplateFolder('Login');
        Mapper::addTemplate('Layouts/Login.php', 'text/html');
    }

    /**
     * Return Template
     *
     * @return null|mixed|string
     */
    public function __show()
    {
        return Mapper::returnTemplate('Layouts/Login.html');
    }
}