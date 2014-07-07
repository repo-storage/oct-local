Eein\Wysiwyg
=======

WYSIWYG FormWidget for OctoberCMS using Trombowyg WYSIWYG editor.


Trombowyg: http://alex-d.github.io/Trumbowyg/#home

Credit for editor to: http://alex-d.fr/

Install
====
To install the editor in place of the code editor for the blog plugin:

1. First install the blog plugin if you haven't...

2. Install `Eein.Wysiwyg`

2. Open rainlab\blog\models\post\fields.yaml -

On line 15, look for

```
secondaryTabs:
  stretch: true
  fields:
    content:
      tab: Edit
      stretch: true
      type: codeeditor
      span: left
      cssClass: no-padding
      options:
        language: markdown
        showGutter: false
        wrapWords: true
        fontSize: 13
        margin: 15

```
You can comment out the coment field and replace it with the following:
```
content:
      type: Eein\Wysiwyg\FormWidgets\Trumbowyg

```
So in the end your partial file might look like this:

```
secondaryTabs:
  stretch: true
  fields:
    # content:
    #   tab: Edit
    #   stretch: true
    #   type: codeeditor
    #   span: left
    #   cssClass: no-padding
    #   options:
    #     language: markdown
    #     showGutter: false
    #     wrapWords: true
    #     fontSize: 13
    #     margin: 15
    content:
      type: Eein\Wysiwyg\FormWidgets\Trumbowyg

    preview:
      type: RainLab\Blog\FormWidgets\Preview
      tab: Edit
      stretch: true
      span: right
      cssClass: no-padding
```

This will likely work for anything that uses fields, So just throw it where you need it!

Future
===

1. Maybe a switcher for code/wysiwyg for people who like to swap alot.
2. Automatic injection, rather than editing .yaml files (if possible)
