<?php namespace Autumn\Pages\Controllers;

use Backend\Facades\BackendMenu;
use Backend\Classes\Controller;

/**
 * Pages Back-end Controller
 */
class Pages extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $bodyClass = 'compact-container';


    public $requiredPermissions = ['autumn.pages.*'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Autumn.Pages', 'pages', 'pages');
    }
}