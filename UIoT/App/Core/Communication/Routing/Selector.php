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

namespace UIoT\App\Core\Communication\Routing;

use UIoT\App\Core\Renders\Resource;
use UIoT\App\Core\Renders\Template;

/**
 * Class Selector
 * @package UIoT\App\Core\Communication\Routing
 */
final class Selector
{
    /**
     * Show the Render
     *
     * @param $instance
     * @return mixed|null|string
     */
    public static function select($instance)
    {
        if ($instance instanceof Resource)
            return $instance->show();
        else if ($instance instanceof Template)
            return $instance->show();
        return null;
    }

    /**
     * Get Render Instance
     *
     * @param $render
     * @return Resource|Template
     */
    public static function instantiate($render)
    {
        return $render;
    }
}