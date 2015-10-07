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

namespace UIoT\App\Data\Controllers;

use UIoT\App\Core\Communication\Routing\Accessor;
use UIoT\App\Data\Models\Controller;

/**
 * Class None
 * @package UIoT\App\Data\Controllers
 */
final class None extends Controller
{
    public function __actionMain()
    {
        /* redirect to Login view */
        Accessor::redirectToController('Login');
    }
}