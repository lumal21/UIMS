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

namespace UIoT\App\Data\Models\Data;

use UIoT\App\Data\Interfaces\Data\ControllerInterface;

/**
 * Class ControllerModel
 * @package UIoT\App\Data\Models\Data
 */
abstract class ControllerModel implements ControllerInterface
{
    /**
     * Default Action
     *
     * @return string
     */
    public function actionMain()
    {
        return '';
    }

    /**
     * Get Controller Factory
     *
     * @SuppressWarnings("unused")
     */
    public function getControllerFactory()
    {
        /* not implemented */
    }
}
