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

/*  License
 *  <UIoT CMS is the default content management system of uiot's
 *  architecture and environment of the client-side.>
    Copyright (C) <2015>  <University of Bras�lia>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * @caution
 * This Class isn't being used.
 *
 * Objective of this class:
 *  Some times the Requests or the Execution of the Script Frozes
 *  The problem is because the request system is server-side,
 *  so if the Process frozes, you can't open another PhP page from your web-server
 *  until you "kill" the process.
 *  This class exists to calculate the execution time average,
 *  and check if the execution time passed a lot of time,
 *  finishing the execution. With a Whoops Error Message.
 */

namespace UIoT\App\Security;

/**
 * Class Timer
 * @package UIoT\App\Security
 */
final class Timer
{
    /**
     * Execution Time
     *
     * @var int|float
     */
    private static $execution_time = 0;

    /**
     * Execution Time Loops
     *
     * @var array
     */
    private static $execution_loops = [];

    /**
     * Set UIoT Execution
     */
    public function __construct()
    {
        self::setExecutionTime(microtime(true));
        self::addExecutionLoop(microtime(true));
    }

    /**
     * Add Execution Loop
     *
     * @param double $execution_loops
     * @return int
     */
    public static function addExecutionLoop($execution_loops)
    {
        self::$execution_loops[] = $execution_loops;
    }

    /**
     * Check if Execution Time is Spending a lot of time
     */
    public static function checkExecutionCrash()
    {
        if (!self::checkLoopInterval())
            self::addExecutionLoop(microtime(true));

        //else
        ///** @todo make a whoops error display message */
        //die('wrong: ' . (self::getExecutionTime() - array_sum(self::getExecutionLoops())));
    }

    /**
     * Check loop Interval Average
     * @todo this math algorithm doesn't work.
     *
     * @return bool
     */
    public static function checkLoopInterval()
    {
        /* check if execution time is bigger than average */
        return (((self::getExecutionTime() / count(self::getExecutionLoops())) + (self::getExecutionTime() - array_sum(self::getExecutionLoops()))) > (array_sum(self::getExecutionLoops()) / count(self::getExecutionLoops())));
    }

    /**
     * Get Execution Time
     *
     * @return int|float
     */
    public static function getExecutionTime()
    {
        return self::$execution_time;
    }

    /**
     * Set Execution Time
     *
     * @param double $execution_time
     * @return float|int
     */
    public static function setExecutionTime($execution_time)
    {
        return (self::$execution_time = $execution_time);
    }

    /**
     * Get Execution Loops
     *
     * @return array
     */
    public static function getExecutionLoops()
    {
        return self::$execution_loops;
    }

    /**
     * Set Execution Loops
     *
     * @param array $execution_loops
     */
    public static function setExecutionLoops($execution_loops)
    {
        self::$execution_loops = $execution_loops;
    }

    /**
     * Update Execution Time
     */
    public static function updateTime()
    {
        self::setExecutionTime(microtime(true));
    }
}