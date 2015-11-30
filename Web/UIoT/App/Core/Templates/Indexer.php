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

namespace UIoT\App\Core\Templates;

use UIoT\App\Core\Helpers\Manipulators\Constants;
use UIoT\App\Core\Helpers\Visual\Html;

/**
 * Class Indexer
 * @package UIoT\App\Core\Templates
 */
final class Indexer
{
    /**
     * @var string
     */
    public static $folder = '';

    /**
     * Set Template Folder
     *
     * @param string $f
     */
    public static function setTemplateFolder($f)
    {
        self::$folder = (Constants::returnConstant('RESOURCE_FOLDER') . $f . '/');
    }

    /**
     * Add Template
     *
     * @param string $file_name
     */
    public static function addTemplate($file_name)
    {
        Html::add(self::parseTemplateFile(self::$folder . $file_name));
    }

    /**
     * Parse Template File
     *
     * @param string $file_name
     * @return string
     */
    public static function parseTemplateFile($file_name = '')
    {
        ob_start();

        include_once $file_name;
        $template = ob_get_contents();
        ob_end_clean();

        return $template;
    }

    /**
     * Return Template
     *
     * @return string
     */
    public static function returnTemplates()
    {
        return Html::getf();
    }
}
