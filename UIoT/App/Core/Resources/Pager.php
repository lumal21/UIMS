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

/**
 * Class Pager
 * @package UIoT\App\Core\Resources
 */
final class Pager
{
    /**
     * Set Page Title
     *
     * @param string $page_title
     */
    public static function setTitle($page_title)
    {
        echo "<title>{$page_title}</title>";
    }

    /**
     * Add Embed Script
     *
     * @param $script_name
     */
    public static function addEmbedScript($script_name)
    {
        /* first add resource */
        Mapper::addResource($script_name, 'script/javascript');

        /* so echo the script */
        echo sprintf('<script type="text/javascript">%s</script>', Mapper::returnResource($script_name, false));
    }
}