<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Тестовое задание</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="/public/js/libs/jquery.validate.min.js"></script>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?=uri('index')?>">Список задач</a>
                </li>

                <?php if(isAuth()):?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=uri('logout')?>">Выход</a>
                    </li>
                <?php else:?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=uri('login')?>">Вход</a>
                    </li>
                <?php endif;?>

            </ul>
        </div>
    </nav>