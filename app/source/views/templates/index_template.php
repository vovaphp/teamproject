<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Index Page</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<header>
    <h1>TEAMPROJECT </h1>
    <p>FRONTEND PAGES</p>
    <nav>
        <ul id="main-menu">
            <?php if(!empty($articles)):?>
                <?php foreach ($articles as $article):?>
                    <li class="page"><a href="<?=\core\Route::url('index','read',$article['id'])?>" title="<?=$article['title']?>"><?=$article['title']?></a></li>
                <?php endforeach;?>
            <?php endif;?>
        </ul>
    </nav>
    <div class="lang">
        <?php if (isset($_SESSION['login'])):?>
            <p><a href="<?=\core\Route::url('admin','index')?>">Админ панель</a></p>
        <?php else: ?>
            <p><a href="<?=\core\Route::url('admin','authorisation')?>">Войти</a></p>
        <?php endif; ?>
    </div>
</header>
<main>
<?php include_once \core\View::VIEWS_DIR . '/pages/'.$page.'_page.php'?>
</main>
<footer>
    <p>2022@ All rights reserved</p>
</footer>
</body>
</html>