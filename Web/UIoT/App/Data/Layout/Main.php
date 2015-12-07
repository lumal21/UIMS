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

namespace UIoT\App\Data\Layout;

use UIoT\App\Core\Helpers\Visual\Pages;
use UIoT\App\Core\Resources\Indexer as ResourceIndexer;
use UIoT\App\Core\Templates\Indexer as TemplateIndexer;
use UIoT\App\Data\Models\LayoutModel;

/**
 * Class Main
 * @package UIoT\App\Data\Layout
 */
class Main extends LayoutModel
{
	/**
	 * Set Resources
	 * (Main)
	 */
	public static function __resources()
	{
		ResourceIndexer::setResourceFolder('Default');
		ResourceIndexer::addResource('Stylesheet/Styles.css', 'text/css');
		ResourceIndexer::addResource('Stylesheet/Foundation.old.css', 'text/css');
		ResourceIndexer::setResourceFolder('Vendor');
		ResourceIndexer::addResource('Bower/Foundation-sites/Dist/Foundation.css', 'text/css');
		ResourceIndexer::addResource('Bower/Jquery/Dist/Jquery.js', 'script/javascript');
		ResourceIndexer::addResource('Bower/Foundation-sites/Dist/Foundation.min.js', 'script/javascript');
		ResourceIndexer::addResource('Bower/Foundation-sites/Js/Foundation.core.js', 'script/javascript');
		ResourceIndexer::addResource('Bower/Foundation-sites/Js/Foundation.offcanvas.js', 'script/javascript');
		ResourceIndexer::addResource('Bower/Foundation-sites/Js/Foundation.util.triggers.js', 'script/javascript');
		ResourceIndexer::addResource('Bower/Foundation-sites/Js/Foundation.util.motion.js', 'script/javascript');
		ResourceIndexer::setResourceFolder('Main');
		ResourceIndexer::addResource('Stylesheet/Main.css', 'text/css');
	}

	/**
	 * Set Configuration
	 */
	public function __configuration()
	{
		Pages::setTitle('PIKAA');
	}

	/**
	 * Set Templates
	 */
	public function __templates()
	{
		TemplateIndexer::setTemplateFolder('Main');
		TemplateIndexer::addTemplate('Layouts/Main.php');
	}

	/**
	 * Return Template Code
	 *
	 * @return null|mixed|string
	 */
	public function __show()
	{
		return TemplateIndexer::returnTemplates();
	}
}
