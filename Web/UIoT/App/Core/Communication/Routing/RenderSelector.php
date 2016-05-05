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
     * @param RenderInterface $render selected Render
     * @return mixed|null|string Render response
     */
    public static function go(RenderInterface $render)
    {
        if ($render instanceof AssetRender ||
            $render instanceof ControllerRender ||
            $render instanceof ResourceRender
        ) {
            return $render->show();
        }

        return null;
    }
}
