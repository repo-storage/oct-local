<?php namespace OctoDevel\OctoCase\Models;

use App;
use Str;
use Model;
use October\Rain\Support\Markdown;
use October\Rain\Support\ValidationException;

class Item extends Model
{
    public $table = 'octodevel_octocase_items';

    /*
     * Validation
     */
    public $rules = [
        'title' => 'required',
        'slug' => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:octodevel_octocase_items'],
        'content' => '',
        'resume' => '',
        'meta_title' => '',
        'meta_description' => ''
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['published_at'];

    public $belongsToMany = [
        'categories' => ['OctoDevel\OctoCase\Models\Category', 'table' => 'octodevel_octocase_items_categories', 'order' => 'name']
    ];

    public $attachMany = [
        'images' => ['System\Models\File', 'order' => 'sort_order'],
    ];

    /**
     * Lists items for the front end
     * @param  array $options Display options
     * @return self
     */
    public function listFrontEnd($options)
    {
        /*
         * Default options
         */
        extract(array_merge([
            'page' => 1,
            'perPage' => 30,
            'sort' => 'created_at',
            'sortDir' => 'desc',
            'categories' => null,
            'search' => '',
            'published' => true
        ], $options));

        $allowedSortingOptions = ['title','created_at', 'updated_at', 'published_at'];
        $searchableFields = ['title', 'slug', 'resume', 'content'];

        App::make('paginator')->setCurrentPage($page);
        $obj = $this->newQuery();

        if ($published)
            $obj->isPublished();

        /*
         * Sorting
         */
        if (!is_array($sort)) $sort = [$sort];
        foreach ($sort as $_sort) {

            $parts = explode(' ', $_sort);
            if (count($parts) < 2) array_push($parts, $sortDir);
            list($sortField, $sortDirection) = $parts;

            if (in_array($sortField, $allowedSortingOptions))
                $obj->orderBy($_sort, $sortDir);
        }

        /*
         * Search
         */
        $search = trim($search);
        if (strlen($search)) {
            $obj->searchWhere($search, $searchableFields);
        }

        /*
         * Categories
         */
        if ($categories !== null) {
            if (!is_array($categories)) $categories = [$categories];
            $obj->whereHas('categories', function($q) use ($categories) {
                $q->whereIn('id', $categories);
            });
        }

        return $obj->paginate($perPage);
    }

    public function afterValidate()
    {
        if ($this->published && !$this->published_at)
            throw new ValidationException([
               'published_at' => 'Please specify the published date'
            ]);
    }

    public function scopeIsPublished($query)
    {
        return $query
            ->whereNotNull('published')
            ->where('published', '=', 1)
        ;
    }

    public function beforeSave()
    {
        $this->meta_description = strip_tags($this->meta_description);
        // Update content text
        $content = str_replace(array('<br>', '<br/>', '<br />', '</p>'), ' ', $this->content);
        $this->content_text = strip_tags($content);
    }
}