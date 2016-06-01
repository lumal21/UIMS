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

namespace UIoT\App\Core\Assets;

use UIoT\App\Core\Layouts\Factory;
use UIoT\App\Data\Models\Data\RenderModel;

/**
 * Class Render
 * @package UIoT\App\Core\Assets
 */
final class Render extends RenderModel
{
    /**
     * Show Asset Content
     *
     * @return mixed
     */
    public function showContent()
    {
        $layout = Factory::get($this->className);

        $layout->getResources();

        return $layout->getAsset()->dump($this->classMethod);
    }
}
