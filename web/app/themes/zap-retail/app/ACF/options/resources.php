<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$resource = new FieldsBuilder('resources_footer');

$resource->addRelationship('select_resource_footer', [
  'post_type' => ['downloads'],
  'filters' => [
    0 => 'search',
  ],
  'min' => '',
  'max' => '',
]);


$resource->setLocation('options_page', '==', 'site-options');

return $resource;
