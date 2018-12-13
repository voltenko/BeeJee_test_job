<?php require_once 'templates/header.php' ?>

<h1 class="text-center">
    Вход администратора
</h1>

<form action="<?=uri('login')?>" method="post">
    <div class="form-group">
        <label for="userName">Имя пользователя</label>
        <input type="text" name="login" id="userName" class="form-control">
    </div>

    <div class="form-group">
        <label for="password">Пароль</label>
        <input type="password" name="password" class="form-control" id="password">
    </div>

    <button type="submit" class="btn btn-primary">Войти</button>
</form>

<?php require_once 'templates/footer.php' ?>
