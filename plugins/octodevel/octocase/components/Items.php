<?php namespace OctoDevel\OctoCase\Components;

use App;
use Request;
use Redirect;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use OctoDevel\OctoCase\Models\Item as OctoCaseItem;
use OctoDevel\OctoCase\Models\Category as OctoCaseCategory;

class Items extends ComponentBase
{
    public $items;
    public $itemPage;
    public $pageParam;
    public $category;
    public $categoryPage;
    public $noItemsMessage;
    public $itemPageIdParam;
    public $categoryPageIdParam;

    public function componentDetails()
    {
        return [
            'name'        => 'OctoCase Item List',
            'description' => 'Displays a list of latest octocase items on the page.'
        ];
    }

    public function defineProperties()
    {
        return [
            'itemsPerPage' => [
                'title'             => 'Items per page',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'Invalid format of the items per page value.',
                'default'           => '10',
            ],
            'pageParam' => [
                'title'       => 'Pagination parameter name',
                'description' => 'The expected parameter name used by the pagination pages.',
                'type'        => 'string',
                'default'     => ':page',
            ],
            'itemOrderParam' => [
                'title'       => 'Order item by',
                'description' => 'Select the order you want to show the items. Leave empty to order by published_at and updated_at.',
                'type'        => 'dropdown',
                'default'     => ''
            ],
            'itemOrderDirParam' => [
                'title'       => 'Order item direction',
                'description' => 'Select the order direction you want to show the items. Leave empty to order desc.',
                'type'        => 'dropdown',
                'default'     => ''
            ],
            'categoryFilter' => [
                'title'       => 'Category filter',
                'description' => 'Enter a category slug or URL parameter to filter the items by. Leave empty to show all items.',
                'type'        => 'string',
                'default'     => ':slug'
            ],
            'categoryPage' => [
                'title'       => 'Category page',
                'description' => 'Name of the category page file for the "Posted into" category links. This property is used by the default component partial.',
                'type'        => 'dropdown',
                'default'     => 'octocase/category'
            ],
            'categoryPageIdParam' => [
                'title'       => 'Category page param name',
                'description' => 'The expected parameter name used when creating links to the category page.',
                'type'        => 'string',
                'default'     => ':slug',
            ],
            'itemPage' => [
                'title'       => 'Item page',
                'description' => 'Name of the octocase item page file for the "Learn more" links. This property is used by the default component partial.',
                'type'        => 'dropdown',
                'default'     => 'octocase/item'
            ],
            'itemPageIdParam' => [
                'title'       => 'Item page param name',
                'description' => 'The expected parameter name used when creating links to the item page.',
                'type'        => 'string',
                'default'     => ':slug',
            ],
            'noItemsMessage' => [
                'title'        => 'No items message',
                'description'  => 'Message to display in the octocase item list in case if there are no items. This property is used by the default component partial.',
                'type'         => 'string',
                'default'      => 'No items found'
            ],
        ];
    }

    public function getCategoryPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function getItemPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function getItemOrderParamOptions()
    {
        return ['' => '- default -', 'title' => 'Title', 'published_at' => 'Published at', 'created_at' => 'Created at'];
    }

    public function getItemOrderDirParamOptions()
    {
        return ['' => '- default -', 'asc' => 'Ascending', 'desc' => 'Descending'];
    }

    public function onRun()
    {
        $this->category = $this->page['category'] = $this->loadCategory();
        $this->items = $this->page['items'] = $this->listItems();

        $currentPage = $this->propertyOrParam('pageParam');

        if ($currentPage > ($lastPage = $this->items->getLastPage()) && $currentPage > 1)
            return Redirect::to($this->controller->currentPageUrl([$this->property('pageParam') => $lastPage]));

        $this->prepareVars();
    }

    protected function prepareVars()
    {
        $this->pageParam = $this->page['pageParam'] = $this->property('pageParam');
        $this->noItemsMessage = $this->page['noItemsMessage'] = $this->property('noItemsMessage');

        /*
         * Page links
         */
        $this->itemPage = $this->page['itemPage'] = $this->property('itemPage');
        $this->itemPageIdParam = $this->page['itemPageIdParam'] = $this->property('itemPageIdParam');
        $this->categoryPage = $this->page['categoryPage'] = $this->property('categoryPage');
        $this->categoryPageIdParam = $this->page['categoryPageIdParam'] = $this->property('categoryPageIdParam');
    }

    protected function listItems()
    {
        $orderBy = $this->propertyOrParam('itemOrderParam');
        $orderDir = $this->propertyOrParam('itemOrderDirParam');
        $orderDirBase = 'desc';

        $orderBase = ['published_at', 'updated_at'];
        $categories = $this->category ? $this->category->id : null;

        return OctoCaseItem::make()->listFrontEnd([
            'page'       => $this->propertyOrParam('pageParam'),
            'sort'       => ($orderBy ? $orderBy : $orderBase),
            'sortDir'    => ($orderDir ? $orderDir : $orderDirBase),
            'perPage'    => $this->property('itemsPerPage'),
            'categories' => $categories
        ]);
    }

    public function loadCategory()
    {
        if (!$categoryId = $this->propertyOrParam('categoryFilter'))
            return null;

        if (!$category = OctoCaseCategory::whereSlug($categoryId)->first())
            return null;

        return $category;
    }
}