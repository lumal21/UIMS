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
 * @copyright University of Bras�lia
 */

namespace UIoT\App\Data\Models;

use UIoT\App\Data\Interfaces\Method as InterfaceMethod;

/**
 * Class Method
 * @package UIoT\App\Data\Models
 */
class Method implements InterfaceMethod
{
    /** @var object */
    private $data;

    /**
     * Get Data
     *
     * @return array|mixed|object
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set Data
     *
     * @param $data
     * @return $this
     */
    public function setData($data = [])
    {
        $this->data = $data;

        return $this;
    }
}