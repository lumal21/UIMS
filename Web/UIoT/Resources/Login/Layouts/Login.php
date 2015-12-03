<style>
    @import url('/Login/Stylesheet/Styles.css');
    @import url('/Login/Stylesheet/Foundation.css');
</style>
<style type="text/css">
    .bg {
        width: 100%;
        background-image: -webkit-radial-gradient(center, ellipse cover, rgba(255, 255, 255, 0.4) 1%, rgba(255, 255, 255, 0.01) 100%);
        height: 100%;
        position: absolute;
    }

    .bs {
        background: url(/Login/Images/6.jpg);
        background-size: cover;
        background-position-y: -40px;
    }

    .jk {
        top: 10px;
        left: 10px;
        position: absolute;
    }

    .cdd {
        position: absolute;
        opacity: 0.9;
        width: 100%;
        background-color: white;
        padding: 1.25rem;
        border-radius: 3px;
        height: 100%;
        border: 1px solid white;
        top: 0;
        left: 0;
    }

    .kkk {
        background: none;
        border: 0px solid transparent;
    }
</style>
<body class="bs">
<div class="bg">
    <img src="/Login/Images/Logo_small_transparent.png" class="jk"/>
</div>
<div class="nope obese"></div>
<div class="nope obese"></div>
<div class="row">
    <div class="large-3 columns"><br/></div>
    <div class="large-6 columns">
        <div class="panel radius kkk">
            <div class="cdd"></div>
            <div class="nope"></div>
            <form action="/Login/Post" method="POST">
                <div class="row">
                    <div class="large-6 columns">
                        <h5>Login</h5>
                        <?= CONTROLLER_CONTENT; ?>
                    </div>
                    <div class="large-6 columns">
                        <p>Welcome to UIoT administration panel.<br/> This section is restricted to registered users.
                        </p>
                        <input class="button secondary small radius" type="submit" name="submit" value="Login"/>
                    </div>
            </form>
        </div>
    </div>
</div>
<div class="large-3 columns"><br/></div>
</div>
</body>
