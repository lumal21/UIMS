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

namespace UIoT\App\Data\Interfaces;

/**
 * Interface LayoutInterface
 * @package UIoT\App\Data\Interfaces
 */
interface LayoutInterface
{
    /**
     * LayoutInterface constructor.
     */
	public function __construct();

    /**
     * @return mixed
     */
	public static function __resources();

    /**
     * @return mixed
     */
	public function __configuration();

    /**
     * @return mixed
     */
	public function __templates();

    /**
     * @return mixed
     */
	public function __show();
}
