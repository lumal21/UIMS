<?php
/**
     * Created by PhpStorm.
     * User: claudio.santoro
     * Date: 9/29/2015
     * Time: 3:00 PM
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
    function passRequest($a)
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
    function passHandler($a)
    {
        /* store request data */
        $b = new $a($this->request);

        /* return handler */
        return $b;
    }
}