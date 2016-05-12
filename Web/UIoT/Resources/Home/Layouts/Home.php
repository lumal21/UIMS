<style>
    @import url('/Home/Resources/MainStyle.css');
    @import url('/Home/Resources/FoundationOld.css');
    @import url('/Home/Resources/Foundation.css');
    @import url('/Home/Resources/MainMainStyle.css');
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
                            <b>Warning!</b> This CMS is under development phase and is far to be near of the final
                            result content.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="large-6 columns">
                        <ul class="accordion" data-accordion>
                            <li class="accordion-item is-active" data-accordion-item>
                                <a href="#" class="accordion-title">Options</a>
                                <div class="accordion-content" data-tab-content>
                                    Welcome to <b>UIoT uims</b>. We are currently under construction stage. Return here
                                    in the future.
                                </div>
                            </li>
                            <li class="accordion-item" data-accordion-item>
                                <a href="#" class="accordion-title">Menu</a>
                                <div class="accordion-content" data-tab-content>
                                    Blabla Testing Zurb's Accordion
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="large-6 columns">
                        <div class="callout primary">
                            <h5>Server Status</h5>
                            <p>
                                Coverage of Server Status: <span class="secondary label">not configured</span>
                                <br>
                                The `not configured` status, may happen when no data about the <i>UIoT</i> layers are
                                found in the configuration tables.
                            </p>
                            <a class="button small">
                                Click here to went to Server Solution Center
                            </a>
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
<script src="/Home/Resources/Jquery.js"></script>
<script src="/Home/Resources/FoundationJs.js"></script>
<script>
    $(document).foundation();
</script>
<script src="/Home/Resources/FoundationCore.js"></script>
<script src="/Home/Resources/FoundationTriggers.js"></script>
<script src="/Home/Resources/FoundationMotion.js"></script>
<script src="/Home/Resources/FoundationCanvas.js"></script>
<script src="/Home/Resources/FoundationAccordion.js"></script>
