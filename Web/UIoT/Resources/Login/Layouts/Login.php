<style>
    @import url('/Login/Resources/MainStyle.css');
    @import url('/Login/Resources/FoundationOld.css');
    @import url('/Login/Resources/Foundation.css');
</style>
<style type="text/css">
    .bg {
        width: 100%;
        background-image: -webkit-radial-gradient(center, ellipse cover, rgba(255, 255, 255, 0.4) 1%, rgba(255, 255, 255, 0.01) 100%);
        height: 100%;
        position: absolute;
    }

    .bs {
        background: url(/Login/Resources/Background.jpg);
        background-size: cover;
        background-position-y: -40px;
    }

    .jk {
        top: 10px;
        left: 10px;
        position: absolute;
    }

    .kkk {
        border: 0 solid transparent;
        border-radius: 2px;
        opacity: 0.975;
        padding: 30px;
    }
</style>
<body class="bs">
<div class="bg">
    <img src="/Login/Resources/Logo.png" class="jk"/>
</div>
<div class="nope obese"></div>
<div class="nope obese"></div>
<div class="nope obese"></div>
<div class="row">
    <div class="large-3 columns"><br/></div>
    <div class="large-6 columns">
        <div class="callout radius kkk">
            <div class="nope"></div>
            <form action="/Login/Post" method="POST">
                <div class="row">
                    <div class="large-6 columns">
                        <h5>Login</h5>
                        {{resource_content}}
                    </div>
                    <div class="large-6 columns">
                        <p>Welcome to UIoT administration panel.<br/> This section is restricted to registered users.
                        </p>
                        <input class="secondary button" type="submit" name="submit" value="Login"/>
                    </div>
            </form>
        </div>
    </div>
</div>
<div class="large-3 columns"><br/></div>
</div>
</body>
