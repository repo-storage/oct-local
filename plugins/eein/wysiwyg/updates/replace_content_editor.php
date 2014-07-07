<?php

//Used for replacing that pesky codeeditor whenever the CMS updates.

$filename = '../../../../modules/cms/classes/content/fields.yaml';
$string = file_get_contents($filename);
$replace = str_replace('codeeditor', 'Eein\Wysiwyg\FormWidgets\Trumbowyg', $string);
file_put_contents($filename, $replace);
