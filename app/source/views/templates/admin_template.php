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
            <li class="page"><a href="/">Главная</a></li>
            <?
            if (isset($_SESSION['login'])):?>
                <li class="page"><a href="<?=\core\Route::url('admin','newArticle')?>">Добавить статью</a></li>
            <?php endif ?>
        </ul>
    </div>
    <div class="lang">
        <p>
            <?
            if (isset($_SESSION['login'])):?>
            Привет,
            <?=$_SESSION['login']; ?>
                <p><a href="<?=\core\Route::url('admin','users')?>">Список пользователей</a></p>
                <p><a href="<?=\core\Route::url('admin','createUser')?>">Добавить пользователя</a></p>
                <p><a href="<?=\core\Route::url('admin','exitUser')?>">Выйти</a></p>
            <?php endif ?></p>
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