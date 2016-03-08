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
 * @developer Igor Moraes
 * @copyright University of Brasília
 */

namespace UIoT\App\Core\Communication\Parsers\Collectors;

use UIoT\App\Data\Models\CollectorModel;

/**
 * Class DeleteCollector
 * @package UIoT\App\Core\Communication\Parsers\Collectors
 */
class DeleteCollector extends CollectorModel
{
    /**
     * @param mixed $a
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
