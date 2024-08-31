<?php namespace App\Entries\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use App\Entries\Models\Entry;

class Entries extends Controller
{
    public $implement = ['Backend\Behaviors\ListController', 'Backend\Behaviors\FormController'];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('App.Entry', 'entry', 'entries');
    }
}

?>