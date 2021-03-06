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

namespace UIoT\App\Core\Templates;

use UIoT\App\Helpers\Manipulation\Constants;
use UIoT\App\Helpers\Visual\Format;

/**
 * Class Factory
 * @package UIoT\App\Core\Templates
 */
final class Factory
{
    /**
     * @var string Template Folder
     */
    private $folder = '';

    /**
     * @var array Custom Parsed Variables
     */
    private $variables = [];

    /**
     * Set Template Folder
     *
     * @param string $templateFolder
     */
    public function setPath($templateFolder)
    {
        $this->folder = (Constants::get('RESOURCE_FOLDER') . $templateFolder . '/');
    }

    /**
     * Add Variable
     *
     * @param string $variableKey
     * @param string $variableValue
     */
    public function setVar($variableKey, $variableValue)
    {
        $this->variables[$variableKey] = $variableValue;
    }

    /**
     * Add Template
     *
     * @param string $templateName
     */
    public function add($templateName)
    {
        Format::add($this->parse($this->folder . $templateName));
    }

    /**
     * Parse Template File
     *
     * @param string $fileName
     *
     * @return string
     */
    public function parse($fileName)
    {
        ob_start();

        echo file_get_contents($fileName);

        $template = ob_get_contents();

        ob_end_clean();

        return $this->extract($template, $this->variables);
    }

    /**
     * Parse Template Variables
     *
     * @param mixed $template
     * @param array $variables
     *
     * @return mixed
     */
    public function extract($template, $variables)
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
    public function get()
    {
        return Format::getFormat();
    }
}
