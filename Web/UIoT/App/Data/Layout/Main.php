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
		ResourceIndexer::setResourceFolder('None');
		ResourceIndexer::addResource('Stylesheet/Styles.css', 'text/css');
		ResourceIndexer::addResource('Stylesheet/Foundation.css', 'text/css');
		ResourceIndexer::addResource('Stylesheet/Font-awesome.css', 'text/css');
		ResourceIndexer::addResource('Images/Marquee-stars.svg', 'image/svg+xml');
		ResourceIndexer::addResource('Fonts/Fontawesome-webfont.woff2', 'font/opentype');
		ResourceIndexer::addResource('Scripts/Vendor/Jquery.js', 'text/javascript');
		ResourceIndexer::addResource('Scripts/Vendor/Modernizr.js', 'text/javascript');
		ResourceIndexer::addResource('Scripts/Foundation.min.js', 'text/javascript');
		ResourceIndexer::addResource('Scripts/Foundation/Foundation.topbar.js', 'text/javascript');
		ResourceIndexer::addResource('Scripts/Foundation/Foundation.offcanvas.js', 'text/javascript');
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
