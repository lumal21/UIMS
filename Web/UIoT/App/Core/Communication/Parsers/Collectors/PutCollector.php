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

namespace UIoT\App\Core\Communication\Parsers\Collectors;

use UIoT\App\Data\Models\Parsers\CollectorModel;

/**
 * Class PutCollector
 * @package UIoT\App\Core\Communication\Parsers\Collectors
 */
class PutCollector extends CollectorModel
{
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
}
