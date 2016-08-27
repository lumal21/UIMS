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
                    <div class="large-12 small-12 columns">
                        <div class="callout success" data-closable>
                            Hey, <b>{{user_name}}</b> what you want to do today?
                        </div>
                        <div class="callout alert" data-closable>
                            <b>Warning!</b> UIMS is under construction and in alpha stage.
                            <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="large-6 columns">
                        <ul class="accordion" data-accordion>
                            <li class="accordion-item is-active" data-accordion-item>
                                <a href="#" class="accordion-title">Message from System (#1)</a>
                                <div class="accordion-content" data-tab-content>
                                    <p>Welcome to <b>UIoT UIMS</b>. I need to remember you that this management system
                                        is under <b>construction!</b></p>
                                    <p>Futurely you can use advanced features to manage your IoT network.</p>
                                </div>
                            </li>
                            <li class="accordion-item" data-accordion-item>
                                <a href="#" class="accordion-title">Message from System (#2)</a>
                                <div class="accordion-content" data-tab-content>
                                    <p><b>UIMS</b> version 1.0.7 gives to you high performance and graphics advances and
                                        bug fixes.</p>
                                    <p>See the full list of changes accessing the GitHub repo, clicking <a
                                            target="_blank" href="https://github.com/uiot/uiot_ux">here</a>.</p>
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
<script src="/Home/Resources/Jquery.js"></script>
<script src="/Home/Resources/FoundationJs.js"></script>
<script>
    $(document).foundation();
</script>
<script src="/Home/Resources/FoundationCore.js"></script>
<script src="/Home/Resources/FoundationTriggers.js"></script>
<script src="/Home/Resources/FoundationMotion.js"></script>
<script src="/Home/Resources/FoundationKeyboard.js"></script>
<script src="/Home/Resources/FoundationAccordion.js"></script>

