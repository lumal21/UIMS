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

use stdClass;

/**
 * Interface RequestDataInterface
 * @package UIoT\App\Data\Interfaces
 */
interface RequestDataInterface
{
    /**
     *
     * RequestDataInterface constructor.
     *
     * @param stdClass $a
     *
     * @return void
     */
    public function __construct(stdClass $a);

    /**
     * @param $a
     *
     * @return mixed
     */
    public function __get($a);

    /**
     * @param $a
     * @param $b
     *
     * @return mixed
     */
    public function __set($a, $b);
}
