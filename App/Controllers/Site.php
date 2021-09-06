<?php
namespace App\Controllers;

use App\View;

class Site
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
    protected function actionIndex()
    {
        $this->view->title = 'Список задач';
        $this->view->tasks = \App\Models\Task::findAll();
        $this->view->users = \App\Models\User::findAll();
        $this->view->display(__DIR__ . '/../templates/todo.php');
    }

}
