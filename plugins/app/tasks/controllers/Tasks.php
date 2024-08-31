<?php namespace App\Tasks\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use App\Tasks\Models\Task;

class Tasks extends Controller
{
    public $implement = ['Backend\Behaviors\ListController', 'Backend\Behaviors\FormController'];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('App.Task', 'task', 'tasks');
    }
}

?>