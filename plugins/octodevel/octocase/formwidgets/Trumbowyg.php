<?php namespace OctoDevel\OctoCase\FormWidgets;

use Backend\Classes\FormWidgetBase;

/**
 * Trumbowyg WYSIWYG Editor
 * Renders a WYSIWYG editor field.
 *
 * @package OctoDevel\OctoCase
 * @author OctoDevel - Trumbowyg by Alex D - http://alex-d.fr/
 */
class Trumbowyg extends FormWidgetBase
{
    /**
     * Widget Details
     */
    public function widgetDetails()
    {
        return [
            'name'        => 'Trumbowyg',
            'description' => 'Renders a wysiwyg field.'
        ];
    }

    /**
     * Renders Partial
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('trumbowyg');
    }

    /**
     * Prepares the list data
     */
    public function prepareVars()
    {
         $this->vars['name'] = $this->formField->getName();
         $this->vars['value'] = $this->model->{$this->columnName};
    }

    /**
     *  Loads Assets
     */
    public function loadAssets()
    {
        $this->addCss('vendor/trumbowyg/design/css/trumbowyg.css');
        //$this->addCss('css/trumbowyg.css');
        $this->addJs('vendor/trumbowyg/trumbowyg.min.js');
        $this->addJs('vendor/trumbowyg/plugins/upload/trumbowyg.upload.js');
        $this->addJs('js/trumbowyg.js');
    }

}