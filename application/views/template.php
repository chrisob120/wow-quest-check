<!DOCTYPE html>
<html>  
<head>
    <meta charset="utf-8" />
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <title><?= $title; ?></title>
    
    <!-- <link rel="shortcut icon" href="<?= asset_url(); ?>images/favicon.ico" type="image/x-icon" /> -->

    <link rel="stylesheet" href="<?= $this->version->auto_version('css', 'css/screen.css'); ?>" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" />
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    
    <script> var base_url = "<?= base_url(); ?>";</script>
</head>
<body>
    <div id="headbar">
        <?= $headbar; ?>
    </div>

    <div id="wrapper">
        <header><?= $header; ?></header>

        <div id="main">

            <div id="content"><?= $content; ?></div>

            <aside id="right"><?= $rightAside; ?></aside>

        </div>

        <footer><?= $footer; ?></footer>
    </div>

    <script src="<?= asset_url(); ?>bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= $this->version->auto_version('js', 'js/common.js'); ?>"></script>
</body>
</html>