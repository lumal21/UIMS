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

use UIoT\App\Data\Interfaces\Json as InterfaceJson;

/**
 * Class Json
 * @deprecated this class isn't used yet.
 * @package UIoT\App\Data\Models\Types
 */
class Json implements InterfaceJson
{
    public function __construct($params)
    {
        $this->__setArray($params);
    }

    public function __setArray($array)
    {
        foreach ($array as $key => $value) {
            $this->$key = $value;
        }
    }

    public function __toEncode()
    {
        return json_encode($this, [JSON_FORCE_OBJECT, JSON_NUMERIC_CHECK]);
    }

    public function __get($var)
    {
        return $this->$var;
    }

    public function __set($var, $value)
    {
        $this->$var = $value;
    }
}