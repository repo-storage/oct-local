<?php namespace OctoDevel\OctoCase;

use Backend;
use Controller;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name'        => 'Octo Case',
            'description' => 'Create a products/services showcase or a sample photo gallery.',
            'author'      => 'Octo Devel',
            'icon'        => 'icon-briefcase'
        ];
    }

    public function registerComponents()
    {
        return [
            'OctoDevel\OctoCase\Components\Item' => 'octocaseItem',
            'OctoDevel\OctoCase\Components\Items' => 'octocaseItems',
            'OctoDevel\OctoCase\Components\Categories' => 'octocaseCategories',
        ];
    }

    public function registerNavigation()
    {
        return [
            'octocase' => [
                'label'       => 'Octo Case',
                'url'         => Backend::url('octodevel/octocase/items'),
                'icon'        => 'icon-briefcase',
                'permissions' => ['octocase.*'],
                'order'       => 500,

                'sideMenu' => [
                    'items' => [
                        'label'       => 'Items',
                        'icon'        => 'icon-th-large',
                        'url'         => Backend::url('octodevel/octocase/items'),
                        'permissions' => ['octocase.access_items'],
                    ],
                    'categories' => [
                        'label'       => 'Categories',
                        'icon'        => 'icon-list-ul',
                        'url'         => Backend::url('octodevel/octocase/categories'),
                        'permissions' => ['octocase.access_categories'],
                    ],
                ]

            ]
        ];
    }

    public function registerFormWidgets()
    {
        return [
            'OctoDevel\OctoCase\FormWidgets\Trumbowyg' => [
                'label' => 'Trumbowyg',
                'alias' => 'trumbowyg'
            ]
        ];
    }

}