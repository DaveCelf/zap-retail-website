<?php

// Add Custom Posts
foreach (glob(__DIR__ . DIRECTORY_SEPARATOR . "CPT/*.php") as $filename) {
    include $filename;
}

// Add ACF functionality
if (function_exists('acf_add_local_field_group')) {
    foreach (glob(__DIR__ . DIRECTORY_SEPARATOR . "ACF/*.php") as $filename) {
        include $filename;
    }
}