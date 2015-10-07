<?php
/**
 * Created by PhpStorm.
 * User: claudio.santoro
 * Date: 10/6/2015
 * Time: 11:51 AM
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
        else
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