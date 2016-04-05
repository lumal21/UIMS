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

namespace UIoT\App\Data\Models\Parsers;

use UIoT\App\Data\Interfaces\Parsers\MethodInterface;

/**
 * Class MethodModel
 * @package UIoT\App\Data\Models
 */
class MethodModel implements MethodInterface
{
    /** @var object|array */
    private $data;

    /**
     * Get Data
     *
     * @return array|object
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set Data
     *
     * @param array $data
     * @return $this
     */
    public function setData($data = [])
    {
        $this->data = $data;

        return $this;
    }
}
