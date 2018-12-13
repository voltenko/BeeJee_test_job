<?php require_once 'templates/header.php' ?>

    <h1 class="text-center">Ошибка</h1>
    <p>
        <?=$data['errorText']?>
        <a href="javascript:history.back(1)">Назад</a>
    </p>

<?php require_once 'templates/footer.php' ?>