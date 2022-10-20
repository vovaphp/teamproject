<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Index Page</title>
    <link rel="stylesheet" href="/css/style.css">
    <style type="text/css">
        header,main,footer {background-color: rgba(255, 253, 253, 0.75);
        }
    </style>
</head>
<body>
<header>
    <h1>TEAMPROJECT</h1>
    <p>ADMIN PANEL</p>
    <div>
        <ul id="main-menu">
            <li class="page"><a href="/">HOME</a></li>
            <li class="page"><a href="<?=\core\Route::url('admin','articles','index')?>">Cтатьи</a></li>
            <li class="page"><a href="<?=\core\Route::url('admin','articles','newArticle')?>">Добавить статью</a></li>
        </ul>
    </div>
    <div class="lang">
        <p> <?php
            if (isset($_SESSION['login'])):?>
                Привет
            <?=$_SESSION['login'];?>
        </p>
        <p><a href="<?=\core\Route::url('admin','users','users')?>">Список пользователей</a></p>
        <p><a href="<?=\core\Route::url('admin','users','createUser')?>">Добавить пользователя</a></p>
        <p><a href="<?=\core\Route::url('admin','users','exitUser')?>">Выйти</a></p>

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