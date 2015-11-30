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

/*  License
 *  <UIoT CMS is the default content management system of uiot's
 *  architecture and environment of the client-side.>
    Copyright (C) <2015>  <University of Bras�lia>

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

use UIoT\App\Core\Controllers\Indexer as ControllerIndexer;
use UIoT\App\Core\Views\Indexer as ViewIndexer;

/*
 * this file is necessary to register public and static controllers and views.
 * if you have a controller, but isn't listed here, the controller will be private.
 * |> registering a controller here, makes the controller assessable by url.
 * |> registering a view, make the view usable. because some views can be internal views.
 * |> also a controller not necessary need a view.
 */

/*
 * attention:
 * remembering:
 * 1. The Controller will have Internal Code that is necessary to be output by "return" tag, you can use "echo" but is not recommended,
 *    also if only have "echo" and not "return" will give error.
 * 2. A View is the File where you can register the layouts used by the view, and other codes that will not be output.
 *    You can put whatever code in a view, like math, gd, or what you want. The code from the view will not be output.
 *    But you can set the code as global, or pass to the controller, also the view return the layout code.
 *    You can set to the view return your code that you coded on the view, and the layout code.
 *    Also you can code a view without layout. The same with controller, you can code controller without view or layout.
 * 3. In a controller you can use views or/and layouts.
 * 4. all Controller actions need follow that: "function __action{ACTION_NAME}()" without the {}
 * 5. The URl is followed by: /your path/controller/action?query_string
 * 6. If the query string has valid format, will converted to a $_GET.
 * 7. Also you can use: /your path/controller/action/query/string/values, the Router will convert to:
 *    $_GET['action'] = query, $_GET['string'] = values, .... ,$_GET[x] = y;
 *    Remember: the first $_GET key will be the action of controller.
 * 8. UIoT uses a Dynamic Resource (Image, Scripts, Etc) Manager.
 *    All resources need be added in the Layout. But how works? Every resource only can be accessed if is Added in
 *    the Layout, and the Resources is added when the Controller Action is called. After that, you can use that Resource
 *    one more time, (F5), after other F5 resource will disappear. (That happens is a hotlink protection)
 * 9. You can learn about resources, opening a Layout.
 * 10. Resources are called by /your path/layout_name/resource_name/
 * 11. Example: Path Resources/Main is not the Resource of Layout Main! You Can on Resource Path, add any folder with any name. (Main Resource Folder)
 *     And you add in: (Example: Layout Login, Resource Folder: MyFolder):
 *     Layout Login:
 *     Mapper::SetResourceFolder('MyFolder');
 *     Mapper::addResource('/Stylesheet/my css.css', 'text/css');
 *     But this resource is accessed by: /your path/login/Stylesheet/my css.css
 *     Resource System work in that way.
 * 12. The default action of a controller is 'main' (__actionMain)
 * 13. The default Controller is 'none';
 * 14. You can learn more about the cms, reading the code, good luck.
 */

/**
 * Register Views
 */

/* login page */
ViewIndexer::addView('Login');

/* test page */
ViewIndexer::addView('Test');

/**
 * Register Controllers
 */

/* login page */
ControllerIndexer::addController('Login');

/* default page */
ControllerIndexer::addController('None');