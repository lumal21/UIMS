<style>
    @import url('/Main/Resources/MainStyle.css');
    @import url('/Main/Resources/FoundationOld.css');
    @import url('/Main/Resources/Foundation.css');
    @import url('/Main/Resources/MainMainStyle.css');
</style>
<body>
<div class="off-canvas-wrapper">
    <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
        <div class="off-canvas position-left" id="uiotCanvas" data-off-canvas>
            <ul class="mobile-ofc vertical menu">
                <li>
                    <a class="button">Welcome, {{user_name}}</a>
                </li>
            </ul>
            <ul class="accordion" data-accordion>
                <li class="accordion-item is-active" data-accordion-item>
                    <a href="#" class="accordion-title">System</a>
                    <div class="accordion-content" data-tab-content>
                        <ul class="submenu vertical menu">
                            <li><a href="/home">Home</a></li>
                            <li><a>Store</a></li>
                            <li><a>Configuration</a></li>
                        </ul>
                    </div>
                </li>
                <li class="accordion-item" data-accordion-item>
                    <a href="#" class="accordion-title">Apps</a>
                    <div class="accordion-content" data-tab-content>
                        <ul class="submenu vertical menu">
                            <li><a href="/Apps/Map">Device Map</a></li>
                            <li><a href="/Apps/Cam">HQ Camera</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
            <ul class="mobile-ofc vertical menu">
                <li>
                    <a href="/" class="button">Logout</a>
                </li>
            </ul>
        </div>
        <div class="off-canvas position-right" id="resourceCanvas" data-off-canvas data-position="right">
            <ul class="mobile-ofc vertical menu">
                <li>
                    <a class="button"><b>UIoT</b> Resources</a>
                    <ul class="submenu menu vertical" data-submenu="">
                        {{menu_content}}
                    </ul>
                <li>
            </ul>
        </div>
        <div class="off-canvas-content" data-off-canvas-content>
            <div class="title-bar">
                <div class="title-bar-left">
                    <button class="menu-icon" type="button" data-open="uiotCanvas"></button>
                    <span class="title-bar-title">
                        <b class="mll">UIoT</b> cms <span class="label regular">alpha</span>
                    </span>
                </div>
                <div class="title-bar-right">
                    <button class="supa-button button primary tiny" type="button" data-open="resourceCanvas">See
                        Resources
                    </button>
                </div>
            </div>
            <section class="main-section">
                <div class="nope obese"></div>
                <div class="row">
                    <div class="large-12 columns">
                        <div class="callout alert" data-closable>
                            <b>Warning!</b> UIMS is under construction and in alpha stage.
                            <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{resource_content}}
                </div>
                <br/><br/><br/><br/>
            </section>
            <section class="footer">
                <div class="callout warning" style="margin-bottom:0">
                    <div class="row">
                        <div class="large-6 columns">
                            <p>
                                <b>
                                    UIoT CMS - Build 1.0.7
                                </b>
                            </p>
                            <p>
                                This CMS uses ZURB's Foundation. © 2016 ZURB, Inc.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
</body>
<script src="/Main/Resources/Jquery.js"></script>
<script src="/Main/Resources/FoundationJs.js"></script>
<script>
    $(document).foundation();
</script>
<script src="/Main/Resources/FoundationCore.js"></script>
<script src="/Main/Resources/FoundationTriggers.js"></script>
<script src="/Main/Resources/FoundationMotion.js"></script>
<script src="/Main/Resources/FoundationCanvas.js"></script>
