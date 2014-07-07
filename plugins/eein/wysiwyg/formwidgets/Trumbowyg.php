<?php namespace Eein\Wysiwyg\FormWidgets;

use Backend\Classes\FormWidgetBase;

/**
 * Trumbowyg WYSIWYG Editor
 * Renders a WYSIWYG editor field.
 *
 * @package Eein\Trumbowyg
 * @author William Volin @ Woodlands Ad Agency - Trumbowyg by Alex D - http://alex-d.fr/
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
        // $this->vars['stretch'] = $this->formField->stretch;
        // $this->vars['size'] = $this->formField->size;
         $this->vars['name'] = $this->formField->getName();
         $this->vars['value'] = $this->model->{$this->columnName};
    }

    /**
     *  Loads Assets
     */
    public function loadAssets()
    {
        $this->addCss('vendor/trumbowyg/design/css/trumbowyg.css');
        $this->addCss('css/trumbowyg.css');
        $this->addJs('vendor/trumbowyg/trumbowyg.min.js');
        $this->addJs('vendor/trumbowyg/plugins/upload/trumbowyg.upload.js');
        $this->addJs('js/trumbowyg.js');
    }

}