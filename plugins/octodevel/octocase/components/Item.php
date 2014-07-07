<?php namespace OctoDevel\OctoCase\Components;

use Cms\Classes\ComponentBase;
use OctoDevel\OctoCase\Models\Item as OctoCaseItem;

class Item extends ComponentBase
{
    public $item;

    public function componentDetails()
    {
        return [
            'name'        => 'OctoCase Single Item',
            'description' => 'Displays an octocase item on the page.'
        ];
    }

    public function defineProperties()
    {
        return [
            'idParam' => [
                'title'       => 'Slug param name',
                'description' => 'The URL route parameter used for looking up the item by its slug.',
                'default'     => ':slug',
                'type'        => 'string'
            ],
        ];
    }

    public function onRun()
    {
        $this->item = $this->loadItem();
        $this->page['item'] = $this->item;
        $this->page->meta_title = isset($this->item->attributes['meta_title']) ? $this->item->attributes['meta_title'] : '';
        $this->page->meta_description = isset($this->item->attributes['meta_description']) ? $this->item->attributes['meta_description'] : '';
    }

    protected function loadItem()
    {
        $slug = $this->propertyOrParam('idParam');
        return OctoCaseItem::isPublished()->where('slug', '=', $slug)->first();
    }
}