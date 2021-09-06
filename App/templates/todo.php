<?php $currentDate = date('Y-m-d', time());?>
<html>
<head>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../todo/App/templates/css/bootstrap.css">
    <link rel="stylesheet" href="../todo/App/templates/font/bootstrap-icons.css">
    <script src="../todo/App/templates/js/jquery-3.2.1.min.js"></script>
    <script src="../todo/App/templates/js/bootstrap.min.js"></script>
    <style>
        .disabled{
            background-color: #c3e6cb!important;
        }
    </style>
</head>
<body>
    <div class="container">
      <h2 class="mt-4">Список задач</h2>
        <div class="row">
            <div class="col-md-4">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Добавить задачу</button>
            </div>
        </div>
        <div class="row"><div class="col-md-4">&nbsp;</div></div>
        <div class="row">
            <div class="col-md-6">
                <h5>Сортировка по: </h5>
                <button type="button" class="btn btn-light" id="sortExecuter">Исполнителю</button>
                <button type="button" class="btn btn-light" id="sortDate">Дате создания</button>
                <button type="button" class="btn btn-light" id="sortEndTask">Дате выполнения</button>
                <button type="button" class="btn btn-light" id="sortStatus">По статусу</button>
            </div>
        </div>
        <div class="list-group " id="listTasks">
            <?php foreach ($tasks as $task) : ?>
                <?php if ($task->status==3) $disClass = ' disabled'; else $disClass = '';?>
                <?php if ($currentDate>$task->deadline) $warnClass = "list-group-item-warning"; else $warnClass=''; ?>
                <div class="list-group-item list-group-item-action <?php echo $warnClass?> <?php echo $disClass?>" aria-current="true" id="task-<?php echo $task->id;?>">
                    <div class="row">
                        <div class="col-sm-8"><h5><?php echo $task->name_task;?></h5></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><strong>Описание задачи</strong></div>
                        <div class="col-md-2"><strong>Срок выполнения</strong></div>
                        <div class="col-md-2"><strong>Дата выполнения</strong></div>
                        <div class="col-md-2"><strong>Статус</strong></div>
                        <div class="col-md-1"><strong>Действия</strong></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <?php echo $task->description;?>
                        </div>
                        <div class="col-md-2">
                            <?php echo date('d-m-Y',strtotime($task->deadline));?>
                        </div>
                        <div class="col-md-2">
                            <?php if ($task->end_task == NULL)
                                echo 'Не завершена';
                            else echo date('d-m-Y',strtotime($task->end_task));?>
                        </div>
                        <div class="col-md-2">
                            <label for="selWorkStatus">Статус работы:</label>
                            <select class="form-control" id="selWorkStatus<?php echo $task->id;?>">
                                <?php
                                switch ($task->status){
                                    case 1:
                                        echo '<option value="1" selected>добавлена</option>';
                                        echo '<option value="2">в работе</option>';
                                        echo '<option value="3">завершена</option>';
                                        break;
                                    case 2:
                                        echo '<option value="1" >добавлена</option>';
                                        echo '<option value="2" selected>в работе</option>';
                                        echo '<option value="3">завершена</option>';
                                        break;
                                    case 3:
                                        echo '<option value="1" >добавлена</option>';
                                        echo '<option value="2">в работе</option>';
                                        echo '<option value="3" selected>завершена</option>';
                                        break;
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <a href="#" title="Удалить задание" onclick="showDelModal(<?php echo $task->id;?>)" > <i class="bi bi-trash-fill" style="font-size: 1.5rem; color: indianred;"></i>
                            <a href="#" title="Изменить статус" onclick="changeTaskStatus(<?php echo $task->id;?>)" ><i class="bi bi-save" style="font-size: 1.5rem; "></i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8"><small class="text-muted">Исполнитель: <?php echo $task->users->fam;?></small></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!--ADD Task Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Новая задача</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="newTask" novalidate>
                        <div class="form-group">
                            <label for="taskName" class="col-form-label">Название задачи:</label>
                            <input type="text" class="form-control" name="taskName" required>
                            <div class="invalid-feedback">
                                Заполните название задачи
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="executer">Исполнитель:</label>
                            <select class="form-control" name="executer">
                                <?php foreach ($users as $user) : ?>
                                    <option value="<?php echo $user->id;?>"><?php echo $user->fam;?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-form-label">Описание задачи:</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="deadline" class="col-form-label">Срок выполнения:</label>
                            <input type="date" class="form-control" name="deadline">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                    <button type="button" class="btn btn-primary" id="addTask" >Добавить задачу</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--Delete Task Modal -->
    <div class="modal fade" id="delModal" tabindex="-1" aria-labelledby="delModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delModalLabel">Удаление задачи</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Вы уверены что хотите удалить задачу?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
                    <button type="button" class="btn btn-danger" id="delTask" >Да</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    //Обработка ссылки "удаление задачи"
    function showDelModal(idTask) {
        $('#delModal').modal('show');
        $('#delTask').click(function () {
            $.post("/todo/ajaxDelTask", ({idTask}), function (data) {
                $('#delModal').modal('hide');
                getTasksList();
            });
        });
        //console.log(idTask);
    }
    //Обработка изменения статуса задачи
    function changeTaskStatus(idTask) {
        var selStatus = $('#selWorkStatus'+idTask+' option').filter(':selected').val();
        $.post("/todo/ajaxUpdateStatus",({idTask, selStatus}) ,function (data) {
            getTasksList();
        });
    }
    //Получение списка задач
    function getTasksList(){
        $.post("/todo/ajaxGetTasksList", function (data) {
            $('#listTasks').empty();
            $('#listTasks').html(data);
        });
    }
    //Получение списка задач с сортировкой по дате создания
    $('#sortDate').click(function (){
        $.post("/todo/ajaxGetTasksListByDate", function (data) {
            $('#listTasks').empty();
            $('#listTasks').html(data);
        });
    });
    //Получение списка задач с сортировкой по исполнителю
    $('#sortExecuter').click(function (){
        $.post("/todo/ajaxGetTasksListByExecuter", function (data) {
            $('#listTasks').empty();
            $('#listTasks').html(data);
        });
    });
    //Получение списка задач с сортировкой по статусу задачи
    $('#sortStatus').click(function (){
        $.post("/todo/ajaxGetTasksListByStatus", function (data) {
            $('#listTasks').empty();
            $('#listTasks').html(data);
        });
    });
    //Получение списка задач с сортировкой по дате завершения задачи
    $('#sortEndTask').click(function (){
        $.post("/todo/ajaxGetTasksListByEndTask", function (data) {
            $('#listTasks').empty();
            $('#listTasks').html(data);
        });
    });
    //Обработка кнопки "Добавить задачу"
    $('#addTask').click(function (event) {
        var frmAddTask = $(".newTask").serialize();
        //console.log(frmAddTask);
        $.post("/todo/ajaxAddTask", ({frmAddTask}), function (data) {
            var serverAnswer = $.parseJSON(data);
            if(serverAnswer.status=="success"){
                getTasksList();
            }
            $("#exampleModal").modal('hide');
            //console.log(data)
        });
    });
</script>