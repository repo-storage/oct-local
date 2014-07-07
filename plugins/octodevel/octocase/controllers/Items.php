<?php namespace OctoDevel\OctoCase\Controllers;

use Flash;
use BackendMenu;
use Backend\Classes\Controller;
use OctoDevel\OctoCase\Models\Item;

class Items extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('OctoDevel.OctoCase', 'octocase', 'items');
        $this->addCss('/plugins/octodevel/octocase/assets/css/octodevel.octocase.css');
        $this->addJs('/plugins/octodevel/octocase/assets/js/octodevel.octocase.js');
    }

    public function index()
    {
        $this->vars['postsTotal'] = Item::count();
        $this->vars['postsPublished'] = Item::isPublished()->count();
        $this->vars['postsDrafts'] = $this->vars['postsTotal'] - $this->vars['postsPublished'];

        $this->getClassExtension('Backend.Behaviors.ListController')->index();
    }

    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $postId) {
                if (!$post = Item::find($postId))
                    continue;

                $post->delete();
            }

            Flash::success('Successfully deleted those items.');
        }

        return $this->listRefresh();
    }

    /**
     * {@inheritDoc}
     */
    public function listInjectRowClass($record, $definition = null)
    {
        if (!$record->published)
            return 'safe disabled';
    }
}