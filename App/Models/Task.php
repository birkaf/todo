<?php


namespace App\Models;

use App\Model;
class Task extends Model
{
    const TABLE = 'tasks';

    public $name_task;
    public $description;
    public $user_id;
    public $deadline;
    public $end_task;
    public $status;

    public function __get($k)
    {
        switch ($k) {
            case 'users':
                return User::findById($this->user_id);
                break;
            default:
                return null;
        }
    }
    public function __isset($k)
    {
        switch ($k) {
            case 'users':
                return !empty($this->user_id);
                break;
            default:
                return false;
        }
    }
}