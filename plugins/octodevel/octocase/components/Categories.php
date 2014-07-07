<?php namespace OctoDevel\OctoCase\Components;

use DB;
use App;
use Request;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use OctoDevel\OctoCase\Models\Category as OctoCaseCategory;

class Categories extends ComponentBase
{
    public $categories;
    public $categoryPage;
    public $currentCategorySlug;
    public $categoryPageIdParam;

    public function componentDetails()
    {
        return [
            'name'        => 'OctoCase Category List',
            'description' => 'Displays a list of octocase categories on the page.'
        ];
    }

    public function defineProperties()
    {
        return [
            'idParam' => [
                'title'       => 'Slug param name',
                'description' => 'The URL route parameter used for looking up the current category by its slug. This property is used by the default component partial for marking the currently active category.',
                'default'     => ':slug',
                'type'        => 'string'
            ],
            'categoryPage' => [
                'title'       => 'Category page',
                'description' => 'Name of the category page file for the category links. This property is used by the default component partial.',
                'type'        => 'dropdown',
                'default'     => 'octocase/category'
            ],
            'categoryPageIdParam' => [
                'title'       => 'Category page param name',
                'description' => 'The expected parameter name used when creating links to the category page.',
                'type'        => 'string',
                'default'     => ':slug',
            ],
            'displayEmpty' => [
                'title'       => 'Display empty categories',
                'description' => 'Show categories that do not have any posts.',
                'type'        => 'checkbox',
                'default'     => 0
            ],
        ];
    }

    public function getCategoryPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function onRun()
    {
        $this->categories = $this->page['categories'] = $this->loadCategories();
        $this->categoryPage = $this->page['categoryPage'] = $this->property('categoryPage');
        $this->categoryPageIdParam = $this->page['categoryPageIdParam'] = $this->property('categoryPageIdParam');
        $this->currentCategorySlug = $this->page['currentCategorySlug'] = $this->propertyOrParam('idParam');
    }

    protected function loadCategories()
    {
        $categories = OctoCaseCategory::orderBy('name');
        if (!$this->property('displayEmpty')) {
            $categories->whereExists(function($query) {
                $query->select(DB::raw(1))
                ->from('octodevel_octocase_items_categories')
                ->join('octodevel_octocase_items', 'octodevel_octocase_items.id', '=', 'octodevel_octocase_items_categories.item_id')
                ->whereNotNull('octodevel_octocase_items.published')
                ->where('octodevel_octocase_items.published', '=', 1)
                ->whereRaw('octodevel_octocase_categories.id = octodevel_octocase_items_categories.category_id');
            });
        }

        return $categories->get();
    }
}