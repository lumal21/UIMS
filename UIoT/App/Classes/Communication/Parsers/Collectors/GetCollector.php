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

namespace UIoT\App\Classes\Communication\Parsers\Collectors;

use UIoT\App\Classes\Helpers\JsonHelper;
use UIoT\App\Data\Models\Collector;

/**
 * Class GetCollector
 * @package UIoT\App\Classes\Communication\Parsers\Collectors
 */
class GetCollector extends Collector
{
    /**
     * Pass Request for Gettable
     * @param $a
     * @return $this
     */
    function __passRequest($a)
    {
        /* save request data */
        $this->request = JsonHelper::valueArrayObjectToClosure($a);

        /* return class instance */
        return $this;
    }
}