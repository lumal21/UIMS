<style>
    @import url('/Home/Resources/MainStyle.css');
    @import url('/Home/Resources/FoundationOld.css');
    @import url('/Home/Resources/Foundation.css');
    @import url('/Home/Resources/MainMainStyle.css');
</style>
<body class="jj">

<div class="off-canvas-wrapper">
    <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
        <div class="off-canvas position-left" id="offCanvas" data-off-canvas>
            <ul class="mobile-ofc vertical menu">
                <li>
                    <a href="http://foundation.zurb.com/learn/about.html">Learn</a>
                    <ul class="submenu menu vertical" data-submenu="">
                        <li><a href="http://foundation.zurb.com/learn/about.html">About Foundation</a></li>
                        <li><a href="http://foundation.zurb.com/learn/tutorials.html">Tutorials</a></li>
                        <li><a href="http://foundation.zurb.com/learn/classes.html">Classes</a></li>
                        <li><a href="http://foundation.zurb.com/learn/case-studies.html">Case Studies</a></li>
                        <li><a href="http://foundation.zurb.com/learn/brands.html">Brands</a></li>
                    </ul>
                </li>

                <li>
                    <a href="http://foundation.zurb.com/develop/getting-started.html">Develop</a>
                    <ul class="submenu menu vertical" data-submenu="">
                        <li class="title">Frameworks</li>
                        <li><a href="http://foundation.zurb.com/sites.html">Foundation for Sites</a></li>
                        <li><a href="http://foundation.zurb.com/emails.html">Foundation for Email</a></li>
                        <li><a href="http://foundation.zurb.com/apps.html">Foundation for Apps</a></li>
                        <li class="divider"></li>
                        <li class="title">Develop</li>
                        <li><a href="http://foundation.zurb.com/templates.html">HTML Templates</a></li>
                        <li><a href="http://foundation.zurb.com/sites/resources.html">Resources</a></li>
                        <li><a href="http://foundation.zurb.com/develop/building-blocks.html">Building Blocks</a></li>
                        <li><a href="http://foundation.zurb.com/develop/yeti-launch.html">Yeti Launch</a></li>
                        <li><a href="http://foundation.zurb.com/develop/contribute.html">Contribute</a></li>
                    </ul>
                </li>

                <li><a href="http://foundation.zurb.com/upload.html">Upload</a></li>

                <li>
                    <a href="http://foundation.zurb.com/support/support.html">Support</a>
                    <ul class="submenu menu vertical" data-submenu="">
                        <li><a href="http://foundation.zurb.com/support/support.html">Support Channels</a></li>
                        <li><a href="http://foundation.zurb.com/support/premium-support.html">Premium Support</a></li>
                        <li><a href="http://foundation.zurb.com/forum/sort/unanswered">Foundation Forum</a></li>
                        <li><a href="http://foundation.zurb.com/support/faq.html">FAQs</a></li>
                    </ul>
                </li>

                <li>
                    <a href="http://foundation.zurb.com/frameworks-docs.html">Docs</a>
                    <ul class="submenu menu vertical" data-submenu="">
                        <li><a href="http://foundation.zurb.com/docs/" target="_blank">Sites Docs</a></li>
                        <li><a href="http://foundation.zurb.com/apps/docs/#!/" target="_blank">Apps Docs</a></li>
                        <li><a href="http://zurb.com/ink/docs.php" target="_blank">Email Docs</a></li>
                    </ul>
                </li>

                <li><a href="http://foundation.zurb.com/develop/getting-started.html" class="button">Getting Started</a>
                </li>

            </ul>
        </div>
        <div class="off-canvas-content" data-off-canvas-content>
            <div class="title-bar">
                <div class="title-bar-left">
                    <button class="menu-icon" type="button" data-open="offCanvas"></button>
                <span class="title-bar-title jjk" onclick="window.location.href=''"
                      onMouseOver="this.style.cursor='pointer'">
                <h1 class="title mll"><b>UIoT</b> cms <span class="label regular tbl">alpha</span></h1></span>
                </div>
            </div>

            <section class="main-section">
                <div class="nope obese" id="Closing"></div>
                <div class="row" id="Section1">
                    {{resource_content}}
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



