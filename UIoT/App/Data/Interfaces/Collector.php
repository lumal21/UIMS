<?php
/**
     * Created by PhpStorm.
     * User: claudio.santoro
     * Date: 9/29/2015
     * Time: 2:58 PM
     */

namespace UIoT\App\Data\Interfaces;

/**
 * Interface Collector
 * @package UIoT\App\Data\Interfaces
 */
interface Collector
{
    public function passRequest($a);

    public function passHandler($a);
}