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
 * @developer Igor Moraes
 * @copyright University of Brasília
 */

namespace UIoT\App\Core\Communication\Routing;

use UIoT\App\Core\Resources\Render as ResourceRender;
use UIoT\App\Core\Templates\Render as TemplateRender;
use UIoT\App\Data\Interfaces\RenderInterface;

/**
 * Class Selector
 * @package UIoT\App\Core\Communication\Routing
 */
final class RenderSelector
{
    /**
     * Abbreviation for the CallBacks
     *
     * @param $render
     *
     * @return mixed|null|string
     */
    public static function go($render)
    {
        return self::select($render);
    }

    /**
     * Show the Render
     *
     * @param $instance
     *
     * @return mixed|null|string
     */
    private static function select(RenderInterface $instance)
    {
        if ($instance instanceof ResourceRender)
            return $instance->show();
        else if ($instance instanceof TemplateRender)
            return $instance->show();
        return null;
    }
}
