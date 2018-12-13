<?php require_once 'templates/header.php' ?>

<div>
    <h1 class="text-center">Новая задача</h1>

    <form enctype="multipart/form-data" id="newTaskForm" method="post" action="<?=uri('newTask')?>">
        <div class="form-group row">
            <label for="userName" class="col-sm-2 col-form-label">Имя:</label>
            <div class="col-sm-10">
                <input type="text" name="user_name" class="form-control" id="userName">
            </div>
        </div>

        <div class="form-group row">
            <label for="useEmail" class="col-sm-2 col-form-label">E-mail:</label>
            <div class="col-sm-10">
                <input type="email" name="user_email" class="form-control" id="userEmail">
            </div>
        </div>

        <div class="form-group row">
            <label for="taskText" class="col-sm-2 col-form-label">Текст задачи:</label>
            <div class="col-sm-10">
                <textarea name="task_text" class="form-control" id="taskText"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="image">Изображение:</label>
            <input name="task_img" type="file" class="form-control-file" id="loadImage">
        </div>

        <button type="button" id="previewButton" class="btn btn-primary" data-toggle="modal" data-target="#previewModal">
            Предпросмотр
        </button>
        <input type="submit" class="btn btn-secondary" value="Сохранить">
    </form>

    <!-- Modal -->
    <div class="container modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-preview" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewModalLabel">Предпросмотр</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card task">
                        <div class="row">
                            <div class="col-md-4 task-img">
                                <img src="/public/img/common/no_image.png" alt="preview image" id="previewImage" width="320">
                            </div>

                            <div class="card-body col-md-8">
                                <h5 class="card-title">Имя: <span id="previewName"></span></h5>
                                <h6 class="card-subtitle mb-2 text-muted">E-mail: <span id="previewEmail"></span></h6>
                                <p class="previewText">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Preview modal
    document.querySelector("#loadImage").addEventListener("change", function () {
        if (this.files[0]) {
            var fr = new FileReader();

            fr.addEventListener("load", function () {
                $('#previewImage').attr('src', fr.result);
            }, false);

            fr.readAsDataURL(this.files[0]);
        }
    });

    $('#previewButton').on('click', function () {
        $('#previewName').text($('#userName').val());
        $('#previewEmail').text($('#userEmail').val());
        $('.previewText').text($('#taskText').val());
    });


    // Form validator
    $('#newTaskForm').validate({
        rules: {
            user_name: {
                required: true,
                maxlength: 10
            },
            user_email: {
                required: true,
                email: true,
                maxlength: 20
            },
            task_text: 'required'
        },
        messages: {
            user_name: {
                required: 'Введите имя',
                maxlength: 'Не более 10 символов'
            },
            user_email: {
                required: 'Введите E-mail',
                email: 'E-mail некорректен',
                maxlength: 'Не более 20 символов'
            },
            task_text: 'Введите текст задачи'
        }
    });
</script>

<?php require_once 'templates/footer.php' ?>

