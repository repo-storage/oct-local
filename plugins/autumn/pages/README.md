# Autumn Pages #

Static html pages, data are stored in a DB, WYSIWYG the editor, alternative option to built-in pages, only without components, pure html is used, seo friendly.

This plugin created for people who used CVS for projects and editors need create content without conflicts,

This plugin created for people who need WYSIWYG.

## Summary v1.0.5 ##

* Contains component for output page
* Required [http://octobercms.com/plugin/eein-wysiwyg](http://octobercms.com/plugin/eein-wysiwyg) installation
* Autoset page title
* Support meta keywords and meta desription
* Support component alias



### Installation ###
* Create page e.g. `` /page/:slug ``
* Select page component from components tab
* add  ``{% component 'pageView' %}``
* create link in templates e.g. ``<a href="{{ 'simple-page'|page({'slug': 'about-us'}) }}">About</a>``  where 'simple-page' is name of created page and 'about-us' slug of created page


### How output meta data ###
* add to your layout file
```
        <meta name="description" content="{{ this.page.meta_description}}">
        <meta name="keywords" content="{{ this.page.meta_keywords}}">
```


### Customize ###

* add component to page and set alias if it need (default **pageView** )
* ``{{ pageView.data.title }}`` for output page title
* ``{{ pageView.data.content }}`` for output page content

## That will be in the future ##

* Search by page
* User access

## Other ##
* Icon used from [http://thenounproject.com/](http://thenounproject.com/)
* Git repo for issues [BitBucket repo](http://code.bestxp.pro/oc-pages-plugin/issues)

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="U4WBC265S8FWA">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/ru_RU/i/scr/pixel.gif" width="1" height="1">
</form>