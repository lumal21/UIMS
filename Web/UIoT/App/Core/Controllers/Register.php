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

namespace UIoT\App\Core\Controllers;

use UIoT\App\Helpers\Manipulation\Constants;
use UIoT\App\Helpers\Visual\Format;

/**
 * Class Register
 * @package UIoT\App\Core\Templates
 */
final class Register
{
    /**
     * @var string
     */
    public static $folder = '';

    private static $variables = [];

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
     * Add Variable
     *
     * @param string $key
     * @param string $value
     */
    public static function addVariable($key, $value)
    {
        self::$variables[$key] = $value;
    }

    /**
     * Add Template
     *
     * @param string $fileName
     */
    public static function addTemplate($fileName)
    {
        Format::add(self::parseTemplateFile(self::$folder . $fileName));
    }

    /**
     * Parse Template File
     *
     * @param string $fileName
     * @return string
     */
    public static function parseTemplateFile($fileName = '')
    {
        ob_start();

        echo file_get_contents($fileName);

        $template = ob_get_contents();

        ob_end_clean();

        return self::extractVariables($template, self::$variables);
    }

    /**
     * Parse Template Variables
     *
     * @param mixed $template
     * @param array $variables
     * @return mixed|string
     */
    public static function extractVariables($template = '', $variables)
    {
        foreach ($variables as $word => $content) {
            $template = str_replace($word, $content, $template);
        }

        return $template;
    }

    /**
     * Return Template
     *
     * @return string
     */
    public static function returnTemplates()
    {
        return Format::getFormat();
    }
}
