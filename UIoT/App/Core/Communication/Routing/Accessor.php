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
 * @copyright University of Brasília
 */

namespace UIoT\App\Core\Communication\Routing;

use UIoT\App\Core\Renders\Template;
use UIoT\App\Core\Views\Indexer as VIndexer;

/**
 * Class Accessor
 * @package UIoT\App\Core\Communication\Routing
 */
final class Accessor
{
    /**
     * Redirect to Another View
     *
     * @param string $view
     * @return mixed
     */
    static function RedirectToView($view)
    {
        return VIndexer::getView($view);
    }

    /**
     * Redirect to Another Controller
     *
     * @param $controller
     * @param string $controller_action
     * @return Template
     */
    static function RedirectToController($controller, $controller_action = '')
    {
        return (new Template($controller, ((!empty($controller_action)) ? $controller_action : DEFAULT_VIEW_ACTION)));
    }
}