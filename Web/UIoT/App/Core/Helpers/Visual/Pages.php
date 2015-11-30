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

namespace UIoT\App\Core\Helpers\Visual;

use UIoT\App\Core\Resources\Indexer;

/**
 * Class Pages
 * @package UIoT\App\Core\Helpers\Visual
 */
final class Pages
{
    /**
     * Set Page Title
     *
     * @param string $page_title
     */
    public static function setTitle($page_title)
    {
        Html::add("<title>{$page_title}</title>");
    }

    /**
     * Add Embed Script
     *
     * @param $script_name
     */
    public static function addEmbedScript($script_name)
    {
        /* first add resource */
        Indexer::addResource($script_name, 'script/javascript');

        /* so echo the script */
        Html::add(sprintf('<script type="text/javascript">%s</script>', Indexer::returnResource($script_name, false)));
    }
}
