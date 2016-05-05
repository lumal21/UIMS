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

namespace UIoT\App\Helpers\Visual;

use UIoT\App\Core\Assets\Register;

/**
 * Class Pages
 * @package UIoT\App\Helpers\Visual
 */
final class Pages
{
    /**
     * Set Page Title
     *
     * @param string $pageTitle
     */
    public static function setTitle($pageTitle)
    {
        Html::add("<title>{$pageTitle}</title>");
    }

    /**
     * Add Embed Script
     *
     * @param $scriptName
     */
    public static function addEmbedScript($scriptName)
    {
        /* First add resource */
        Register::addAsset($scriptName, 'script/javascript');

        /* So echo the script */
        Html::add(sprintf('<script type="text/javascript">%s</script>', Register::returnResource($scriptName)));
    }
}
