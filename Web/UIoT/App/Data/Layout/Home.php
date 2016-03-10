<?php

/**
 * UIoTuims
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
 * @app UIoT User-Friendly Management System
 * @author UIoT
 * @developer Claudio Santoro
 * @developer Igor Moraes
 * @copyright University of Brasília
 */

namespace UIoT\App\Data\Layout;

use UIoT\App\Core\Controllers\Commander;
use UIoT\App\Core\Helpers\Visual\Pages;
use UIoT\App\Core\Templates\Indexer as TemplateIndexer;

/**
 * Class Home
 *
 * @package UIoT\App\Data\Layout
 */
class Home extends Main
{
    /**
     *
     * Set Configuration
     */
    public function __configuration()
    {
        Pages::setTitle('Welcome to UIoT');
    }

    /**
     *
     * Set Templates
     */
    public function __templates()
    {
        TemplateIndexer::setTemplateFolder('Home');
        TemplateIndexer::addVariable('{{resource_content}}', Commander::getControllerContent());
        TemplateIndexer::addTemplate('Layouts/Home.php');
    }

    /**
     *
     * Return Template Code
     *
     * @return null|mixed|string
     */
    public function __show()
    {
        return TemplateIndexer::returnTemplates();
    }
}
