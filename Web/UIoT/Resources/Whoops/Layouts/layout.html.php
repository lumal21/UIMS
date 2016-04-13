<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title><?php echo $tpl->escape($page_title) ?></title>

    <style><?= $tpl->display($stylesheet); ?></style>
</head>
<body>

<div class="Whoops container">
    <div class="stack-container">
        <div class="left-panel cf <?php echo(!$has_frames ? 'empty' : '') ?>">
            <header>
                <?php $tpl->render($header) ?>
            </header>

            <div class="frames-description">
                Stack frames (<?php echo count($frames) ?>):
            </div>

            <div class="frames-container">
                <?php $tpl->render($frame_list) ?>
            </div>
        </div>
        <div class="details-container cf">
            <?php $tpl->render($frame_code) ?>
            <?php $tpl->render($env_details) ?>
        </div>
    </div>
</div>

<script><?= $tpl->display($zepto); ?></script>
<script><?= $tpl->display($clipboard); ?></script>
<script><?= $tpl->display($javascript); ?></script>
</body>
</html>


