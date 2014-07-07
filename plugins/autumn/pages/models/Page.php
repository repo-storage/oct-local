<?php namespace Autumn\Pages\Models;

use October\Rain\Database\Model;

/**
 * Page Model
 */
class Page extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'autumn_pages';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Validation rules
     */
    public $rules = [
        'title' => 'required',
        'slug' => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i'],
        'content' => 'required',
        'meta_description' => '',
        'meta_keywords' => '',
    ];

    public $slugs = [
        'slug' => 'slug'
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'user' => ['Backend\Models\User']
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}