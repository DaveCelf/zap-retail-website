<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$resource = new FieldsBuilder('product_options', ['title' => 'Products']);

$resource->addTextArea('product_options_notice', [
    'label' => 'Product Notice',
]);


$resource->setLocation('options_page', '==', 'site-options');

return $resource;
