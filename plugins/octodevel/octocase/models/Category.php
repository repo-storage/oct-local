<?php namespace OctoDevel\OctoCase\Models;

use Str;
use Model;
use OctoDevel\OctoCase\Models\Item;

class Category extends Model
{
    public $table = 'octodevel_octocase_categories';

    /*
     * Validation
     */
    public $rules = [
        'name' => 'required',
        'slug' => 'required|between:3,64|unique:octodevel_octocase_categories',
        'code' => 'unique:octodevel_octocase_categories',
        'description' => ''
    ];

    protected $guarded = [];

    public function beforeValidate()
    {
        // Generate a URL slug for this model
        if (!$this->exists && !$this->slug)
            $this->slug = Str::slug($this->name);
    }

    public function items()
    {
        // @todo: declare this relationship as the class field when the conditions option is implemented
        return $this->belongsToMany('OctoDevel\OctoCase\Models\Item', 'octodevel_octocase_items_categories')->isPublished()->orderBy('published_at', 'desc');
    }

    public function itemCount()
    {
        return $this->items()->count();
    }
}