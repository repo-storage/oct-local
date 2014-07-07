# OctoCase Plugin

Create a products/services showcase or a sample photo gallery.

## How do this work

The plugin provides several components for building the item list page, category page, item details page and category list for the sidebar.

### Item list page

Use the `octocaseItems` component to display a list of latest octocase items on a page. The component has the following properties:

* **categoryFilter** - a category slug or URL parameter (:slug) to filter the items by. If left blank, all items are displayed.
* **itemsPerPage** - how many items to display on a single page (the pagination is supported automatically). The default value is 10.
* **pageParam** - how expected parameter name used by the pagination pages. The default value is **:page**.
* **itemOrderParam** - how is the order to show the items. The default value is by published_at and updated_at.
* **itemOrderDirParam** - how is the direction order to show the items. The default is descending.
* **categoryFilter** - how is expected parameter name name to filter the items by. The default value is **:slug**.
* **categoryPage** - path to the category page. The default value is **octocase/category** - it matches the pages/octocase/category.htm file in the theme directory. This property is used in the default component partial for creating links to the octocase categories.
* **categoryPageIdParam** how expected parameter name used by category items page. The default value is **:slug**.
* **itemPage** - path to the item details page. The default value is **octocase/item** - it matches the pages/octocase/item.htm file in the theme directory. This property is used in the default component partial for creating links to the octocase items.
* **noItemsMessage** - message to display in the empty item list.

The `octocaseItems` component injects the following variables to the page where it's used:

* **items** - a list of octocase items loaded from the database.
* **itemPage** - contains the value of the `itemPage` component's property.
* **category** - the octocase category object loaded from the database. If the category is not found, the variable value is **null**.
* **categoryPage** - contains the value of the `categoryPage` component's property.
* **noItemsMessage** - contains the value of the `noItemsMessage` component's property.

The component supports pagination and reads the current page index from the `:page` URL parameter. The next example shows the basic component usage on the octocase home page:

    title = "OctoCase"
    url = "/octocase/:page?"

    [octocaseItems]
    itemsPerPage = "5"
    ==
    {% component 'octocaseItems' %}

The next example shows the basic component usage with the category filter:

    title = "OctoCase Category"
    url = "/octocase/category/:slug/:page?"

    [octocaseItems]
    categoryFilter = ":slug"
    ==
    function onEnd()
    {
        // Optional - set the page title to the category name
        if ($this['category'])
            $this->page->title = $this['category']->name;
    }
    ==
    {% if not category %}
        <h2>Category not found</h2>
    {% else %}
        <h2>{{ category.name }}</h2>

        {% component 'octocaseItems' %}
    {% endif %}

The item list and the pagination are coded in the default component partial `plugins/octodevel/octocase/components/items/default.htm`. If the default markup is not suitable for your website, feel free to copy it from the default partial and replace the `{% component %}` call in the example above with the partial contents.

### Item page

Use the `octocaseItem` component to display a octocase item on a page. The component has the following properties:

* **idParam** - the URL route parameter used for looking up the item by its slug. The default value is **:slug**.

The component injects the following variables to the page where it's used:

* **octocaseItem** - the octocase item object loaded from the database. If the item is not found, the variable value is **null**.

The next example shows the basic component usage on the octocase page:

    title = "OctoCase Item"
    url = "/octocase/item/:slug"

    [octocaseItem item]
    ==
    <?php
    function onEnd()
    {
        // Optional - set the page title to the item title
        if (isset($this['octocaseItem']))
            $this->page->title = $this['octocaseItem']->title;
    }
    ?>
    ==
    {% if not octocaseItem %}
        <h2>Item not found</h2>
    {% else %}
        <h2>{{ octocaseItem.title }}</h2>

        {% component 'item' %}
    {% endif %}

The item details is coded in the default component partial `plugins/octodevel/octocase/components/item/default.htm`.

### Category list

Use the `octocaseCategories` component to display a list of octocase item categories with links. The component has the following properties:

* **idParam** - the URL route parameter used for looking up the current category by its slug. The default value is **:slug**.
* **categoryPage** - path to the category page. The default value is **octocase/category** - it matches the pages/octocase/category.htm file in the theme directory. This property is used in the default component partial for creating links to the octocase categories.
* **categoryPageIdParam** - how expected parameter name used by category items page. The default value is **:slug**.
* **displayEmpty** - determines if empty categories should be displayed. The default value is false.

The component injects the following variables to the page where it's used:

* **categoryPage** - contains the value of the `categoryPage` component's property.
* **categories** - a list of octocase categories loaded from the database.
* **currentCategorySlug** - slug of the current category. This property is used for marking the current category in the category list.

The component can be used on any page. The next example shows the basic component usage on the octocase home page:

    title = "OctoCase"
    url = "/octocase/:page?"

    [octocaseCategories]
    ==
    ...
    <div class="sidebar">
        {% component 'octocaseCategories' %}
    </div>
    ...

The category list is coded in the default component partial `plugins/octodevel/octocase/components/categories/default.htm`.