<?php namespace Autumn\Pages;

use System\Classes\PluginBase;
use Backend;
/**
 * Pages Plugin Information File
 */
class Plugin extends PluginBase
{

    public $require = [
        'Eein.Wysiwyg',
    ];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Autumn Pages',
            'description' => 'Pages, data stored in DB, seo friendly, wysiwyg',
            'author'      => 'bestxp (<a href="http://bestxp.pro">http://bestxp.pro</a>)',
            'icon'        => 'icon-file-o'
        ];
    }

    public function registerNavigation()
    {
        return [
            'pages' => [
                'label'       => 'Pages',
                'url'         => Backend::url('autumn/pages/pages'),
                'icon'        => 'icon-file-o',
                'permissions' => ['autumn.pages.*'],
                'order'       => 500,

                'sideMenu' => [
                    'pages' => [
                        'label'       => 'All pages',
                        'icon'        => 'icon-copy',
                        'url'         => Backend::url('autumn/pages/pages'),
                        'permissions' => ['autumn.pages.access_pages'],
                    ],

                ]

            ]
        ];
    }


    public function registerComponents(){
        return [
            'Autumn\Pages\Components\PageView' => 'pageView'
        ];
    }

    public function registerPermissions(){
        return [
            'autumn.pages.access_pages' => ['label' => 'Pages access', 'tab' => 'Pages']
        ];
    }
}
