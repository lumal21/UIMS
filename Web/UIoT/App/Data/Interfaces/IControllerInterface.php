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

namespace UIoT\App\Data\Interfaces;

/**
 * Interface IControllerInterface
 * @package UIoT\App\Data\Interfaces
 */
interface IControllerInterface
{
    /**
     *
     * IControllerInterface constructor.
     *
     * @return null
     */
    public function __construct();

    /**
     * @param $a
     * @param $b
     *
     * @return mixed
     */
    public function __call($a, $b);
}
