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

/**
 * Class Add
 * @package UIoT\App\Data\Layout
 */
final class Add extends Main
{
    /**
     * Set Configuration
     */
    public function __configuration()
    {
        Pager::setTitle('Addachu');
    }

    /**
     * Set Template
     */
    public function __templates()
    {
        Mapper::setTemplateFolder('Main');
        Mapper::addTemplate('Layouts/Main.php', 'text/html');
    }

    /**
     * Return Template
     *
     * @return null|string|mixed
     */
    public function __show()
    {
        return Mapper::returnTemplate('Layouts/Main.html');
    }
}