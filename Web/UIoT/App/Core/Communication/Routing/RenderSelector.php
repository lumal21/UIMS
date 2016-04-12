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

namespace UIoT\App\Core\Communication\Routing;

use UIoT\App\Core\Assets\AssetRender as AssetRender;
use UIoT\App\Core\Controllers\Render as ControllerRender;
use UIoT\App\Core\Resources\Render as ResourceRender;
use UIoT\App\Data\Interfaces\Parsers\RenderInterface;

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
        if ($instance instanceof AssetRender)
            return $instance->show();
        else if ($instance instanceof ControllerRender)
            return $instance->show();
        else if ($instance instanceof ResourceRender)
            return $instance->show();
        return null;
    }
}
