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

namespace UIoT\App\Core\Communication\Methods;

use UIoT\App\Data\Models\Parsers\MethodModel;

/*
 * Warning:
 * Communication Methods Aren't the HTTP REST Request Methods!
 * These Classes aren't being used for RAISE communication!
 *
 * This class is used for Internal CMS Communication.
 * This class is used for PhP GET, POST Methods
 * ($_GET, $_POST) in REST Version
 *
 * The PhP $_GET REST Version is the PhP Query String
 * The PhP $_POST REST Version is the PhP $_POST
 *
 * Please don't Mistake the Types!
 * This isn't for REST communication!
 */

/**
 * Class Get
 * @package UIoT\App\Core\Communication\Methods
 */
final class Get extends MethodModel
{

}
