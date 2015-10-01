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

namespace UIoT\App\Classes\Communication\Parsers\Handlers;

use UIoT\App\Data\Models\Handler;

/**
 * Class Puttable
 * @package UIoT\App\Classes\Communication\Parsers\Methods
 */
class Puttable extends Handler
{
    /**
     * @param $request_content
     */
    function __construct($request_content)
    {
        $this->content .= '<pre>';
        $this->content .= print_r($request_content, true);
        $this->content .= '</pre>';
    }
}