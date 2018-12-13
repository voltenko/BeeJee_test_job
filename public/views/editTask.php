<?php require_once 'templates/header.php' ?>

<div>
    <h1 class="text-center">Редактирование задачи</h1>

    <form action="<?=uri('editTask')?>" method="post" id="editTaskForm">
        <div class="form-group row">
            <label for="userName" class="col-sm-2 col-form-label">Имя:</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="userName" value="<?=htmlspecialchars($data['task']['user_name'])?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="userEmail" class="col-sm-2 col-form-label">E-mail:</label>
            <div class="col-sm-10">
                <input type="email" readonly class="form-control-plaintext" id="userEmail" value="<?=htmlspecialchars($data['task']['user_email'])?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="taskText" class="col-sm-2 col-form-label">Текст задачи:</label>
            <div class="col-sm-10">
                <textarea name="task_text" class="form-control" id="taskText"><?=htmlspecialchars($data['task']['text'])?></textarea>
            </div>
        </div>

        <div class="form-group text-center">
            <input name="status" class="form-check-input" type="checkbox" id="defaultCheck1"
            <?php if($data['task']['status']): ?>
                checked
            <?php endif;?>>
            <label class="form-check-label" for="defaultCheck1">
                Выполнено
            </label>
        </div>

        <input type="hidden" name="id" value="<?=$data['task']['id']?>">

        <input type="submit" class="btn btn-secondary" value="Сохранить">
        <a href="<?=uri('deleteTask')?>?id=<?=$data['task']['id']?>" class="btn btn-danger">Удалить</a>
    </form>
</div>

    <script>
        // Form validator
        $('#editTaskForm').validate({
            rules: {
                task_text: 'required'
            },
            messages: {
                task_text: 'Введите текст задачи'
            }
        });
    </script>

<?php require_once 'templates/footer.php' ?>