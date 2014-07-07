<?php namespace Autumn\Pages\Components;

use Autumn\Pages\Models\Page;
use Cms\Classes\ComponentBase;
use Cms\Classes\Layout;
use Cms\Classes\Theme;
use Response;
use View;

class PageView extends ComponentBase
{

    public $data;
    public $layout;

    public function componentDetails()
    {
        return [
            'name'        => 'Autumn Pages',
            'description' => 'Outputs page data'
        ];
    }

    public function defineProperties()
    {
        return [
            'paramId' => [
                'description' => 'The URL route parameter used for looking up the post by its slug.',
                'title'       => 'Slug param name',
                'default'     => 'slug',
                'type'        => 'string'
            ]
        ];
    }


    public function onInit()
    {
        $this->data = $this->loadData();

        if(!$this->data){

           return Response::make($this->controller->run('404'), 404);
        }

        $this->page[$this->alias] = $this;
        $this->page->title = $this->data->title;
        $this->page->meta_description = $this->data->meta_description;
        $this->page->meta_keywords = $this->data->meta_keywords;

    }

    protected function loadData()
    {
        $slug = $this->param($this->property('paramId'));
        return Page::make()->where('slug', '=', $slug)->first();
    }

}