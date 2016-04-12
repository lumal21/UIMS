<style>
    .ooo {
        background: #FAFAFA;
        box-shadow: 1px 1px 7px gray;
        z-index: 1000;
    }

    .mobile-ofc {
        background: #121212;
        font-size: 0.8125rem;
        font-weight: bold;
    }

    .mobile-ofc .menu a {
        height: 45px;
        line-height: 45px;
        color: #e6e6e6;
        padding-top: 0;
        padding-bottom: 0;
    }

    .mobile-ofc .menu a:hover:not(.button), .mobile-ofc .menu a:focus {
        background: black;
    }

    .mobile-ofc .menu a.button {
        border-radius: 0;
        box-shadow: 0 0 0 transparent;
    }

    .mobile-ofc .title {
        color: #8a8a8a;
        padding: 10px;
        padding-left: 15px;
        font-size: 0.8em;
        background: #2c2c2c;
    }

    .menu {
        margin: 0;
        list-style-type: none;
    }

    .menu > li {
        display: table-cell;
        vertical-align: middle;
    }

    .menu > li:not(.menu-text) > a {
        display: block;
        padding: 0.7rem 1rem;
        line-height: 1;
    }

    .menu input,
    .menu a,
    .menu button {
        margin-bottom: 0;
    }

    .menu > li > a > img,
    .menu > li > a > i {
        vertical-align: middle;
    }

    .menu > li > a > span {
        vertical-align: middle;
    }

    .menu > li > a > img,
    .menu > li > a > i {
        display: inline-block;
        margin-right: 0.25rem;
    }

    .menu > li {
        display: table-cell;
    }

    .menu.vertical > li {
        display: block;
    }

    @media screen and (min-width: 40em) {
        .menu.medium-horizontal > li {
            display: table-cell;
        }

        .menu.medium-vertical > li {
            display: block;
        }
    }

    @media screen and (min-width: 64em) {
        .menu.large-horizontal > li {
            display: table-cell;
        }

        .menu.large-vertical > li {
            display: block;
        }
    }

    .menu.simple a {
        padding: 0;
        margin-right: 1rem;
    }

    .menu.align-right > li {
        float: right;
    }

    .menu.expanded {
        display: table;
        width: 100%;
    }

    .menu.expanded > li:nth-last-child(2):first-child,
    .menu.expanded > li:nth-last-child(2):first-child ~ li {
        width: 50%;
    }

    .menu.expanded > li:nth-last-child(3):first-child,
    .menu.expanded > li:nth-last-child(3):first-child ~ li {
        width: 33.33333%;
    }

    .menu.expanded > li:nth-last-child(4):first-child,
    .menu.expanded > li:nth-last-child(4):first-child ~ li {
        width: 25%;
    }

    .menu.expanded > li:nth-last-child(5):first-child,
    .menu.expanded > li:nth-last-child(5):first-child ~ li {
        width: 20%;
    }

    .menu.expanded > li:nth-last-child(6):first-child,
    .menu.expanded > li:nth-last-child(6):first-child ~ li {
        width: 16.66667%;
    }

    .menu.expanded > li:first-child:last-child {
        width: 100%;
    }

    .menu.icon-top > li > a {
        text-align: center;
    }

    .menu.icon-top > li > a > img,
    .menu.icon-top > li > a > i {
        display: block;
        margin: 0 auto 0.25rem;
    }

    .menu.nested {
        margin-left: 1rem;
    }

    .menu-text {
        font-weight: bold;
        color: inherit;
        line-height: 1;
        padding: 0.7rem 1rem;
    }

    .off-canvas-wrapper {
        width: 100%;
        overflow-x: hidden;
        position: relative;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -webkit-overflow-scrolling: touch;
    }

    .off-canvas-wrapper-inner {
        position: relative;
        width: 100%;
        transition: -webkit-transform 0.5s ease;
        transition: transform 0.5s ease;
    }

    .off-canvas-wrapper-inner::before, .off-canvas-wrapper-inner::after {
        content: ' ';
        display: table;
    }

    .off-canvas-wrapper-inner::after {
        clear: both;
    }

    .off-canvas-content {
        min-height: 100%;
        background: #fefefe;
        transition: -webkit-transform 0.5s ease;
        transition: transform 0.5s ease;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        z-index: 1;
        box-shadow: 0 0 10px rgba(10, 10, 10, 0.5);
    }

    .js-off-canvas-exit {
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(254, 254, 254, 0.25);
        cursor: pointer;
        transition: background 0.5s ease;
    }

    .is-off-canvas-open .js-off-canvas-exit {
        display: block;
    }

    .off-canvas {
        position: absolute;
        background: #e6e6e6;
        z-index: -1;
        max-height: 100%;
        overflow-y: auto;
        -webkit-transform: translateX(0px);
        -ms-transform: translateX(0px);
        transform: translateX(0px);
    }

    [data-whatinput='mouse'] .off-canvas {
        outline: 0;
    }

    .off-canvas.position-left {
        left: -250px;
        top: 0;
        width: 250px;
    }

    .is-open-left {
        -webkit-transform: translateX(250px);
        -ms-transform: translateX(250px);
        transform: translateX(250px);
    }

    .off-canvas.position-right {
        right: -250px;
        top: 0;
        width: 250px;
    }

    .is-open-right {
        -webkit-transform: translateX(-250px);
        -ms-transform: translateX(-250px);
        transform: translateX(-250px);
    }

    [data-whatinput='mouse'] .menu > li {
        outline: 0;
    }

</style>
<style>
    @import url('/Main/Resources/MainStyle.css');
    @import url('/Main/Resources/FoundationOld.css');
    @import url('/Main/Resources/Foundation.css');
    @import url('/Main/Resources/MainMainStyle.css');
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
<script src="/Main/Resources/Jquery.js"></script>
<script src="/Main/Resources/FoundationJs.js"></script>
<script>
    $(document).foundation();
</script>
<script src="/Main/Resources/FoundationCore.js"></script>
<script src="/Main/Resources/FoundationTriggers.js"></script>
<script src="/Main/Resources/FoundationMotion.js"></script>
<script src="/Main/Resources/FoundationCanvas.js"></script>



