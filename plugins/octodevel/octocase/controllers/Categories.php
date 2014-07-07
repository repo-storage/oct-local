<?php namespace OctoDevel\OctoCase\Controllers;

use Flash;
use BackendMenu;
use Backend\Classes\Controller;
use OctoDevel\OctoCase\Models\Category;

class Categories extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('OctoDevel.OctoCase', 'octocase', 'categories');
    }

    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $postId) {
                if (!$post = Category::find($postId))
                    continue;

                $post->delete();
            }

            Flash::success('Successfully deleted those categories.');
        }

        return $this->listRefresh();
    }
}