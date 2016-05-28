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

            <!-- Close button -->
            <button class="close-button" aria-label="Close menu" type="button" data-close>
                <span aria-hidden="true">&times;</span>
            </button>

            <ul class="mobile-ofc vertical menu">

                <li>
                    <a>Welcome, Guest User.</a>
                    <ul class="submenu menu vertical" data-submenu="">
                        <li><a href="/home">Home</a></li>
                        <li><a>Docs</a></li>
                    </ul>
                <li>

                <li><a class="button">Logout</a></li>

            </ul>

        </div>
        <div class="off-canvas position-right" id="resourceCanvas" data-off-canvas data-position="right">

            <ul class="mobile-ofc vertical menu">

                <li>
                    <a><b>UIoT</b> Resources</a>
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
                        <div class="callout alert">
                            <b>Warning!</b> This CMS is under development phase and is far to be near of the final
                            result content.
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{resource_content}}
                </div>
            </section>

            <section>
                <div class="callout secondary" style="margin-bottom:0">
                    <div class="row">
                        <div class="large-6 columns">
                            <p>
                                <b>
                                    UIoT CMS - Build 1.0.6
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
