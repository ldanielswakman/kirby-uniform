<?php

if (defined('KIRBY')) {
    // Register all Uniform assets

    $kirby = kirby();
    $kirby->set('snippet', 'uniform/errors', __DIR__.DS.'snippets'.DS.'errors.php');
    $kirby->set('snippet', 'uniform/email-default', __DIR__.DS.'snippets'.DS.'email-default.php');
    $kirby->set('snippet', 'uniform/email-table', __DIR__.DS.'snippets'.DS.'email-table.php');

    if (!$kirby->site()->multilang()) {
        require_once __DIR__.DS.'languages'.DS.c::get('uniform.language', 'en').'.php';
    }
}
