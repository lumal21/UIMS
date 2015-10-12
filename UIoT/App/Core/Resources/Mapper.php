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

namespace UIoT\App\Core\Resources;

use UIoT\App\Core\Communication\Sessions\Indexer as SIndexer;
use UIoT\App\Core\Layouts\Indexer as LIndexer;
use UIoT\App\Exception\Register;

/**
 * Class Mapper
 * @package UIoT\App\Core\Resources
 */
final class Mapper
{
    /**
     * @var array
     */
    public static $the_array = [];
    /**
     * @var array
     */
    public static $the_t_array = [];
    /**
     * @var string
     */
    public static $folder = '';
    /**
     * @var string
     */
    public static $t_folder = '';

    /**
     * Set Resource Folder
     *
     * @param string $f
     */
    public static function setResourceFolder($f)
    {
        self::$folder = (RESOURCE_FOLDER . $f . '/');
    }

    /**
     * Set Template Folder
     *
     * @param string $f
     */
    public static function setTemplateFolder($f)
    {
        self::$t_folder = (RESOURCE_FOLDER . $f . '/');
    }

    /**
     * Add Resource
     *
     * @param string $file_name
     * @param string $mime_type
     */
    public static function addResource($file_name, $mime_type)
    {
        self::$the_array[$file_name] = [
            'mime_type' => $mime_type,
            'file_content' => self::parseResourceFile(self::$folder . $file_name)
        ];
    }

    /**
     * Add Template
     *
     * @param string $file_name
     * @param string $mime_type
     */
    public static function addTemplate($file_name, $mime_type)
    {
        self::$the_t_array[$file_name] = [
            'mime_type' => $mime_type,
            'file_content' => self::parseTemplateFile(self::$t_folder . $file_name)
        ];
    }

    /**
     * Return Template
     *
     * @param string $file_name
     * @return string
     */
    public static function returnTemplate($file_name)
    {
        return ((self::checkTemplateExistence($file_name)) ? (self::$the_t_array[$file_name]['file_content']) : '');
    }

    /**
     * Check if Template Exists
     *
     * @param string $file_name
     * @return bool
     */
    public static function checkTemplateExistence($file_name)
    {
        return array_key_exists($file_name, self::$the_t_array);
    }

    /**
     * Return Layout Resources
     *
     * @param string $layout_name
     * @param bool $reset_session
     * @return mixed
     */
    public static function registerResources($layout_name, $reset_session = false)
    {
        /* remove if is needed */
        (!$reset_session) || SIndexer::removeKey('layout');

        /* register the layout */
        LIndexer::addLayout($layout_name, strtok($layout_name, '_'));

        /* get layout resources */
        LIndexer::getLayoutResources($layout_name);

        /* resource must change */
        self::calculateResourceChanges();
    }

    /**
     * Calculate Resource Changes
     *
     * These void is used to generate the final array.
     * if a new resource is added, the algorithm will use the local array
     * if isn't added new resources, but a resource is removed (if already used), he return the session array
     * also if don't exists any changes the session array will be used.
     *
     * @bug the algorithm only will work on second resource instantiation
     * The reason of these algorithm is only the page-side resources must be loaded.
     * to protect XSS, and hot-links.
     */
    public static function calculateResourceChanges()
    {
        // get array values
        $resourc_array = (array)array_keys(self::$the_array);

        /* if the session doesn't exists, add then */
        (SIndexer::keyExists('layout')) || SIndexer::addKey('layout', $resourc_array);

        $session_array = (array)SIndexer::getKeyValue('layout');

        // mount array with removed items
        $removed_array = (array)array_diff($session_array, $resourc_array);

        // mount final array
        $final_array = ((empty($removed_array)) ? $session_array : $resourc_array);

        // store array
        SIndexer::updateKey('layout', $final_array);
    }

    /**
     * Check if Session array exists, if yes, return the session array as resource array
     * if not, return local array.
     *
     * @return array
     */
    public static function getResourcesArray()
    {
        return ((SIndexer::keyExists('layout')) ? (array)SIndexer::getKeyValue('layout') : (array)array_keys(self::$the_array));
    }

    /**
     * Update Resource Change
     *
     * @param string $file_name
     */
    public static function updateResourceChange($file_name)
    {
        SIndexer::updateKey('layout', self::resourceRemove($file_name));
    }

    /**
     * Return Resource
     *
     * @param string $file_name
     * @param boolean $header
     * @return string
     */
    public static function returnResource($file_name, $header = true)
    {
        /* if resource doesn't exists, or resource is hotlinked we must show error */
        (self::checkResourceExistence($file_name)) || (Register::$global->errorMessage(9003,
            "Stop! D'not Hotlinks!",
            'Details: ',
            [
                'What Happened?' => "You're a bitch, and trying to get resources...",
                'Resolution:' => "Stop giving 555xxxx requests!",
                'Are you the developer?' => 'You can open this same error Page with Developer Code, only need put ?de on the Url'
            ]
        ));

        /* update the resource change */
        self::updateResourceChange($file_name);

        /* add header (mime-type) */
        (!$header) || (header('Content-Type: ' . (self::$the_array[$file_name]['mime_type'])));

        /* return content */
        return self::$the_array[$file_name]['file_content'];
    }

    /**
     * Remove Resource
     *
     * @param string $resource_name
     * @return array
     */
    public static function resourceRemove($resource_name)
    {
        return array_diff(array_keys(self::$the_array), [$resource_name]);
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
     * Parse Resource File
     *
     * @param string $file_name
     * @return string
     */
    public static function parseResourceFile($file_name = '')
    {
        return file_get_contents($file_name);
    }

    /**
     * Check if Resource Exists
     *
     * @param string $file_name
     * @return bool
     */
    public static function checkResourceExistence($file_name)
    {
        return in_array($file_name, self::getResourcesArray());
    }
}