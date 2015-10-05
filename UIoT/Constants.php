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

/*  License
 *  <UIoT CMS is the default content management system of uiot's
 *  architecture and environment of the client-side.>
    Copyright (C) <2015>  <University of Brasília>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace UIoT;

use UIoT\App\Core\Helpers\Manipulators\Constants as C;

/**
 * This file is where you register all Public Constants
 */

/* uiot root folder */
C::__addConstant('ROOT_FOLDER', __DIR__);

/* uiot base folder */
C::__addConstant('BASE_FOLDER', basename(str_replace('UIoT', '', __DIR__)));

/* resources base folder */
C::__addConstant('RESOURCE_FOLDER', (ROOT_FOLDER . '/Resources/'));

/* resource sub-folders (valid callable folders) */
C::__addJConstant('RESOURCE_TYPES', [
        '',
        'Images',
        'Fonts',
        'Less',
        'Scripts',
        'Scss',
        'Stylesheet'
    ]
);

/*
 * @warning it's important register here
 * Here is register all LAYOUT's names, used by UIoT Router
 */
C::__addJConstant('PREDEFINED_LAYOUTS', [
        '',
        'Add',
        'Edit',
        'Login',
        'Main',
        'Remove'
    ]
);

/* request url */
C::__addConstant('REQUEST_URL', @$_SERVER['REQUEST_URI']);

/* script name */
C::__addConstant('SCRIPT_NAME', @$_SERVER['SCRIPT_NAME']);

/* query string */
C::__addConstant('QUERY_STRING', @$_SERVER['QUERY_STRING']);

/* php self */
C::__addConstant('PHP_SELF', @$_SERVER['PHP_SELF']);

/** template constants */

/* default view */
C::__addConstant('DEFAULT_VIEW', 'None');

/* default controller */
C::__addConstant('DEFAULT_CONTROLLER', 'None');

/* default view action */
C::__addConstant('DEFAULT_VIEW_ACTION', 'Main');
