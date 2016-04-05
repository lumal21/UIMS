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

namespace UIoT\App\Data\Models\Requesting;

use stdClass;
use UIoT\App\Data\Interfaces\Requesting\RequestDataInterface;

/**
 * Class RequestDataModel
 * @package UIoT\App\Data\Models
 */
class RequestDataModel extends stdClass implements RequestDataInterface
{
    /**
     * Constructs and Set all Abstract Data
     *
     * RequestDataModel constructor
     *
     * @param stdClass $k
     */
    public function __construct(stdClass $k)
    {
        /* set object vars */
        foreach (get_object_vars($k) as $name => $value)
            $this->{$name} = $value;
    }

    /**
     * Get Something
     *
     * @param mixed $a
     * @return mixed
     */
    public function __get($a)
    {
        return $a;
    }

    /**
     * Set Something
     *
     * @param mixed $a
     * @param mixed $b
     */
    public function __set($a, $b)
    {
        $this->{$a} = $b;
    }
}
