<?php $rand_css= mt_rand()?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>

    <link rel="stylesheet" href="/css/styles.css?id=<?=$rand_css?>" type="text/css">
    <script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>
</head>
<body>
    <div id="wrapper">
        <header class="header">
            <?= $menu ?>
        </header>
        <main>
            <?= $content ?>
        </main>
        <footer>2023</footer>
    </div>
</body>
</html>
