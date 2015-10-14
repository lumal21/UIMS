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
use UIoT\App\Data\Models\Layout;

/**
 * Class Test
 * @package UIoT\App\Data\Layout
 */
class Test extends Layout
{
    /**
     * Set Resources
     */
    public static function __resources()
    {
        ResourceIndexer::setResourceFolder('None');
    }

    /**
     * Set Configuration
     */
    public function __configuration()
    {
        Pages::setTitle('Hello World');
    }

    /**
     * Set Templates
     */
    public function __templates()
    {
        TemplateIndexer::setTemplateFolder('Test');
        TemplateIndexer::addTemplate('Layouts/Test.php');
    }

    /**
     * Return Template
     *
     * @return null|mixed|string
     */
    public function __show()
    {
        return TemplateIndexer::returnTemplates();
    }
}