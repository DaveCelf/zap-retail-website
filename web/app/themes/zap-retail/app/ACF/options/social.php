<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$social = new FieldsBuilder('social_media');
$social->addText('twitter');
$social->addText('facebook');
$social->addText('linkedin');
$social->addText('instagram');

$social->setLocation('options_page', '==', 'site-options');

return $social;
