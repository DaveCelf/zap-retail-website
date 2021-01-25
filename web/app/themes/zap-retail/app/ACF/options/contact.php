<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$contact = new FieldsBuilder('contact');
$contact->addText('email');
$contact->addText('tel');

$contact->setLocation('options_page', '==', 'site-options');

return $contact;
