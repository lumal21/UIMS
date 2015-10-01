<style>
    @import url('/Main/Stylesheet/Styles.css');
    @import url('/Main/Stylesheet/Foundation.css');
    @import url('/Main/Stylesheet/Font-awesome.css');
    @import url('/Main/Stylesheet/Main.css');
</style>
<body class="jj">
<div class="off-canvas-wrap c1"
     data-offcanvas>
    <div class="inner-wrap ppk">
        <nav class="tab-bar kki" id="Menu">
            <section class="left-small ter" id="Section2">
                <a class="left-off-canvas-toggle menu-icon act"><span></span></a>
            </section>
            <section class="right tab-bar-section jjk"
                     onclick="window.location.href=''" onMouseOver="this.style.cursor='pointer'">
                <h1 class="title mll"><b>UIoT</b>
                    cms
                    <span class="label regular tbl">alpha</span></h1>
            </section>
            <section class="right top-bar-section act">
                <ul class="right">
                    <li class="active vgt" id="addme">
                        <a href="../add/" class="act">New</a>
                    </li>
                    <li class="active vgt" id="addstore">
                        <a href="../../store/index" class="act">New</a>
                    </li>
                    <li class="active vgt" id="cancelme">
                        <a href="../list/" class="act">Cancel</a>
                    </li>
                </ul>
            </section>
        </nav>
        <aside class="left-off-canvas-menu" style="background: #FAFAFA;box-shadow: 1px 1px 7px gray;z-index: 1000;">
            <ul class="off-canvas-list main_menu">
                <li><label>Welcome, <b>aa</b></label></li>
            </ul>
            <div class="sidebar">
                <h5>search something on the cms</h5>
                <input id="search_item" tabindex="1" type="search" placeholder="search on the cms" autocomplete="off">
                <nav>
                    <h5 class="result_title">search content result</h5>
                    <ul class="side-nav" id="result_content"></ul>

                    <h5>cms main menu</h5>
                    <ul class="side-nav" id="form_search">
                        <?php
                        $menu_items = new UIoT\App\Classes\Helpers\Visual\MenuItems();
                        $menu_items->__addLabel('Home', 'fa fa-home');
                        $menu_items->__addItem('', 'fa fa-suitcase', '', 'Home', 'Home');
                        $menu_items->__addLabel('System', 'fa fa-sitemap');
                        $menu_items->__addItem('', 'fa fa-server', '', 'Slave Controllers', 'System');
                        $menu_items->__addItem('', 'fa fa-server', '', 'Devices', 'System');
                        $menu_items->__addItem('', 'fa fa-server', '', 'Services', 'System');
                        $menu_items->__addItem('', 'fa fa-server', '', 'Actions', 'System');
                        $menu_items->__addItem('', 'fa fa-server', '', 'Arguments', 'System');
                        $menu_items->__addItem('', 'fa fa-server', '', 'State Variables', 'System');
                        $menu_items->__addLabel('Debugger', 'fa fa-cog');
                        $menu_items->__addItem('', 'fa fa-terminal', '', 'Console', 'Debugger');
                        $menu_items->__addLabel('Store', 'fa fa-shopping-cart');
                        $menu_items->__addItem('', 'fa fa-puzzle-piece', '', 'Store', 'Store');
                        $menu_items->__addItem('', 'fa fa-cube', '', 'Apps', 'Store');
                        $menu_items->__addLabel('You', 'fa fa-user');
                        $menu_items->__addItem('', 'fa fa-users', '', 'Users', 'You');
                        $menu_items->__addItem('', 'fa fa-power-off', '', 'Logout', 'You');
                        $menu_items->__returnItems();
                        ?>
                    </ul>
                </nav>
            </div>
        </aside>

        <section class="main-section">
            <div class="nope obese" id="Closing"></div>
            <div class="row" id="Section1">
                <?= CONTROLLER_CONTENT; ?>
            </div>
        </section>
    </div>
</div>

<script src='/Main/Scripts/Vendor/Jquery.js' type='text/javascript'></script>
<script src='/Main/Scripts/Vendor/Modernizr.js' type='text/javascript'></script>
<script src='/Main/Scripts/Foundation.min.js' type='text/javascript'></script>
<script src='/Main/Scripts/Foundation/Foundation.topbar.js' type='text/javascript'></script>
<script src='/Main/Scripts/Foundation/Foundation.offcanvas.js' type='text/javascript'></script>
<script src='/Main/Scripts/Foundation/Foundation.reveal.js' type='text/javascript'></script>
<script src='/Main/Scripts/Foundation/Foundation.joyride.js' type='text/javascript'></script>
<script src='/Main/Scripts/Foundation/Foundation.dropdown.js' type='text/javascript'></script>
<script src='/Main/Scripts/Foundation/Foundation.abide.js' type='text/javascript'></script>
<script src='/Main/Scripts/Foundation/Foundation.alert.js' type='text/javascript'></script>
<script>
    $(document).foundation();
</script>
</body>