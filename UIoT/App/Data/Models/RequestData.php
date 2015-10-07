<?php
/**
 * Created by PhpStorm.
 * User: claudio.santoro
 * Date: 9/29/2015
 * Time: 2:22 PM
 */

namespace UIoT\App\Data\Models;

use stdClass;
use UIoT\App\Data\Interfaces\RequestData as InterfaceRequestData;

/**
 * Class RequestData
 * @package UIoT\App\Data\Models
 */
class RequestData extends stdClass implements InterfaceRequestData
{
    /**
     * Constructs and Set all Abstract Data
     * @todo Improve these Code...
     *
     * @param stdClass $k
     */
    public function __construct(stdClass $k)
    {
        /* set object vars */
        foreach (get_object_vars($k) as $name => $value) {
            $this->{$name} = $value;
        }
    }

    /**
     * Get Something
     *
     * @param $a
     */
    public function __get($a)
    {
        return $a;
    }

    /**
     * Set Something
     *
     * @param $a
     * @param $b
     */
    public function __set($a, $b)
    {
        $this->{$a} = $b;
    }
}