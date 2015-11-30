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

/**
 * @caution
 * This Class isn't being used.
 *
 * Objective of this class:
 *  Some times the Requests or the Execution of the Script Frozen
 *  The problem is because the request system is server-side,
 *  so if the Process froze, you can't open another PhP page from your web-server
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
	}

	/**
	 * Check loop Interval Average
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
