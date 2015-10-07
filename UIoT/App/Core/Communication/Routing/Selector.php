<?php
/**
     * Created by PhpStorm.
     * User: claudio.santoro
     * Date: 10/6/2015
     * Time: 11:51 AM
     */

namespace UIoT\App\Core\Communication\Routing;

use UIoT\App\Core\Renders\Template;

/**
 * Class Selector
 * @package UIoT\App\Core\Communication\Routing
 */
final class Selector
{
    /**
     * @param Resource|Template $instance
     * @return mixed
     */
    static function select($instance)
    {
        return $instance->show();
    }

    /**
     * @param $render
     * @return Resource|Template
     */
    static function instantiate($render)
    {
        return $render;
    }
}