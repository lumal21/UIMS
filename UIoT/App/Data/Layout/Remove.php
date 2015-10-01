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
 * @copyright University of Brasília
 */

namespace UIoT\Layout;

use UIoT\App\Classes\Resources\Mapper;
use UIoT\App\Classes\Resources\Pager;

/**
 * Class Remove
 * @package UIoT\Layout
 */
final class Remove extends Main
{
    /**
     * Set Configuration
     */
    function __configuration()
    {
        Pager::setTitle('Deletchu');
    }

    /**
     * Set Template
     */
    function __templates()
    {
        Mapper::setTemplateFolder('Main');
        Mapper::addTemplate('Layouts/Main.php', 'text/html');
    }

    /**
     * Return Template
     *
     * @return null|string|mixed
     */
    function __show()
    {
        return Mapper::returnTemplate('Layouts/Main.html');
    }
}