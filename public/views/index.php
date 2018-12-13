<?php require_once 'templates/header.php' ?>

<div class="tasks">
    <h1 class="text-center">Список задач</h1>

    <div class="tasks-buttons row">
        <div class="col-md-6">
            <span>Сортировка:</span>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="<?=uri('index') . '?order=name&num=' . $data['currentPageNum']?>" type="button" class="btn btn-secondary">Имя</a>
                <a href="<?=uri('index') . '?order=email&num=' . $data['currentPageNum']?>" type="button" class="btn btn-secondary">E-mail</a>
                <a href="<?=uri('index') . '?order=status&num=' . $data['currentPageNum']?>" type="button" class="btn btn-secondary">Статус</a>
            </div>
        </div>

        <div class="col-md-6">
            <a href="<?=uri('newTask')?>" type="button" class="btn btn-primary float-right">Добавить задачу</a>
        </div>
    </div>

    <?php foreach ($data['taskList'] as $task):?>
        <div class="card task-card">
            <div class="row">
                <div class="col-md-4 task-img">
                    <img src="<?= $task['img'] ? '/public/img/upload/' . $task['img'] : '/public/img/common/' . Constants::DEFAULT_IMG?>" alt="Task image" width="320">
                </div>

                <div class="card-body col-md-8">
                    <h5 class="card-title">Имя: <?=htmlspecialchars($task['user_name'])?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">E-mail: <?=htmlspecialchars($task['user_email'])?></h6>
                    <p class="card-text">
                        <?=htmlspecialchars($task['text'])?>
                    </p>
                    <p class="cars-text">
                        <?php if($task['status']):?>
                            <b>Выполнено</b>
                        <?php else:?>
                            <b>Невыполнено</b>
                        <?php endif;?>
                    </p>
                    <?php if(isAuth()):?>
                        <a href="<?=uri('editTask') . '?id=' . $task['id']?>" class="card-link">Редактировать</a>
                    <?php endif;?>
                </div>
            </div>
        </div>
    <?php endforeach;?>

    <?php if($data['pagesCount'] > 1):?>
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php if($data['currentPageNum'] > 0):?>
                    <li class="page-item">
                        <a class="page-link"
                        href="<?=uri('index') . '?num=' . strval($data['currentPageNum'] - 1) . '&order=' . $data['order']?>"
                        aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                <?php endif;?>

                <?php for($i = 1; $i <= $data['pagesCount']; $i++):?>
                    <?php if($i - 1 === $data['currentPageNum']):?>
                        <li class="page-item active">
                    <?php else:?>
                        <li class="page-item">
                    <?php endif;?>
                    <a class="page-link"
                       href="<?=uri('index') . '?num=' . strval($i - 1) . '&order=' . $data['order']?>">
                        <?=$i?>
                    </a>
                    </li>
                <?php endfor;?>

                <?php if($data['currentPageNum'] < $data['pagesCount'] - 1):?>
                    <li class="page-item">
                        <a class="page-link"
                        href="<?=uri('index') . '?num=' . strval($data['currentPageNum'] + 1 . '&order=' . $data['order'])?>"
                        aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                <?php endif;?>
            </ul>
        </nav>
    <?php endif; ?>
</div>

<?php require_once 'templates/footer.php' ?>
