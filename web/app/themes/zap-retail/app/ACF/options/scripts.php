<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$scripts = new FieldsBuilder('scripts');
$scripts->addTextArea('script_header', [
  'label' => 'Header'
]);
$scripts->addTextArea('script_body', [
  'label' => 'Body'
]);
$scripts->addTextArea('script_footer', [
  'label' => 'Footer'
]);

$scripts->setLocation('options_page', '==', 'site-options');

return $scripts;
