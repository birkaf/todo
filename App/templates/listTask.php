<?php $currentDate = date('Y-m-d', time());?>
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