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
                    <a href="http://foundation.zurb.com/learn/about.html">
                        Welcome, Test User (cccl_network)
                    </a>
                    <ul class="submenu menu vertical" data-submenu>
                        <li>
                            <a>Home</a>
                        </li>
                        <li>
                            <a>Status</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="button">
                        Check Status
                    </a>
                </li>
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
            </div>

            <section class="main-section">
                <div class="nope obese"></div>
                <div class="row">
                    <div class="large-12 columns">
                        <div class="callout alert">
                            <b>Warning!</b> This CMS is under development phase and is far to be near of the final result content.
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{resource_content}}
                </div>
            </section>

            <section class="footer">
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
