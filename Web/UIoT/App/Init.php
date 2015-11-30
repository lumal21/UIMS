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
 * this is the main file
 * here uiot is started (uiotcms)
 */

namespace UIoT\App;

/**
 * Class Init
 * @package UIoT\App
 */
final class Init
{
	/**
	 * start environment
	 */
	public function __construct()
	{
		/* start exception handler */
		(new Exception\Manager);

		/* start security handler */
		(new Security\Handler);

		/* session register */
		(new Core\Communication\Sessions\Manager);

		/* start raise */
		(new Core\Communication\Requesting\Raise);

		/* register handlers,methods of rest */
		(new Core\Communication\Parsers\DataManager);

		/* start router */
		(new Core\Communication\Routing\Router);
	}

	/**
	 * It's unnecessary but we will do that anyway
	 * Forces all Cycle Collections (\GC)
	 * Reason: The CMS is called async-times, Force all Process terminate is good.
	 */
	public function __destruct()
	{
		/* force gc collect */
		gc_collect_cycles();
	}
}
