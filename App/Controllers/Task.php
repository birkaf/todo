<?php


namespace App\Controllers;

use App\Model;
use App\View;
class Task
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }
    public function action($action)
    {
        $methodName = 'action' . $action;
        return $this->$methodName();
    }
    //Обновление задачи
    protected function actionUpdateTask()
    {
        $idTask = (int)$_POST['idTask'];
        $status = (int)$_POST['selStatus'];
        $task = \App\Models\Task::findById($idTask);
        $task->status = $status;
        if($status==3){
            $task->end_task = date('Y-m-d', time());
        }else{
            $task->end_task = NULL;
        }

        $task->update();
        $task::serverAnswer('success','Task Updated');
    }
    //Удаление задачи
    protected function actionDelTask()
    {
        $idTask = (int)$_POST['idTask'];
        \App\Models\Task::deleteByID($idTask);
        \App\Models\Task::serverAnswer('success','Задача удалена');
    }
    //Получение списка задач с сортировкой по дате завершения
    protected function actionGetTasksListByEndTask()
    {
        $tasks = \App\Models\Task::findAll();
        usort($tasks, function ( $a, $b ) {
            return strtotime($a->end_task) - strtotime($b->end_task);
        });
        $this->view->tasks = $tasks;
        $this->view->users = \App\Models\User::findAll();
        $this->view->display(__DIR__ . '/../templates/listTask.php');
    }
    //Получение списка задач с сортировкой по статусу работы
    protected function actionGetTasksListByStatus()
    {
        $tasks = \App\Models\Task::findAll();
        usort($tasks, function ($a, $b) {
            return strcmp($a->status, $b->status);
        });
        $this->view->tasks = $tasks;
        $this->view->users = \App\Models\User::findAll();
        $this->view->display(__DIR__ . '/../templates/listTask.php');
    }
    //Получение списка задач с сортировкой по дате исполнения
    protected function actionGetTasksListByDate()
    {
        $tasks = \App\Models\Task::findAll();
        usort($tasks, function ( $a, $b ) {
            return strtotime($a->deadline) - strtotime($b->deadline);
        });
        $this->view->tasks = $tasks;
        $this->view->users = \App\Models\User::findAll();
        $this->view->display(__DIR__ . '/../templates/listTask.php');
    }
    //Получение списка задач с сортировкой по исполнителю
    protected function actionGetTasksListByExecuter()
    {
        $tasks = \App\Models\Task::findAll();
        usort($tasks, function ($a, $b) {
            return strcmp($a->users->fam, $b->users->fam);
        });
        $this->view->tasks = $tasks;
        $this->view->users = \App\Models\User::findAll();
        $this->view->display(__DIR__ . '/../templates/listTask.php');
    }
    //Получение списка задач
    protected function actionGetTasksList()
    {
        $this->view->tasks = \App\Models\Task::findAll();
        $this->view->users = \App\Models\User::findAll();
        $this->view->display(__DIR__ . '/../templates/listTask.php');
    }
    //Добавить новую задачу
    protected function actionAddNewTask()
    {
        parse_str($_POST['frmAddTask'],$arrTaskData);
        $task = new \App\Models\Task();
        $task->name_task = $arrTaskData['taskName'];
        $task->user_id = $arrTaskData['executer'];
        $task->description = $arrTaskData['description'];
        $task->deadline = $arrTaskData['deadline'];
        $task->status = 1;
        $task->end_task = NULL;
        $task->insert();
        $task::serverAnswer('success','Task Added');
    }
}