<?php

$EM_CONF[$_EXTKEY] = array(
    'title' => 'm:e Shortlink Manager',
    'description' =>
        'Extension to set shortlinks for different pages. ' .
        'It is also possible, to add google analytics tracking on this pages.',
    'category' => 'fe',
    'author' => 'move:elevator',
    'author_email' => 'typo3@move-elevator.de',
    'author_company' => 'move:elevator',
    'shy' => '',
    'priority' => '',
    'module' => '',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => 0,
    'createDirs' => '',
    'modify_tables' => '',
    'clearCacheOnLoad' => 0,
    'lockType' => '',
    'version' => '1.7.0',
    'constraints' => array(
        'depends' => array(
            'typo3' => '6.2.0-8.7.99',
        ),
        'conflicts' => array(),
        'suggests' => array(),
    ),
);
