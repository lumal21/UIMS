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

use UIoT\App\Data\Interfaces\Collector as InterfaceCollector;

/**
 * Class Collector
 * @package UIoT\App\Data\Models
 */
class Collector implements InterfaceCollector
{
    protected $request;

    /**
     * @param $a
     * @return $this
     */
    public function passRequest($a)
    {
        /* save request data */
        $this->request = $a;

        /* return class instance */
        return $this;
    }

    /**
     * @param $a
     * @return $this
     */
    public function passHandler($a)
    {
        /* store request data */
        $b = new $a($this->request);

        /* return handler */
        return $b;
    }
}