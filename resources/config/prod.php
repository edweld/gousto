<?php

/**
 * Dynamic configuration settings
 * @author: Ed Weld <edweld@gmail.com>
 * @package edweld/gousto <https://github.com/edweld/gousto>
 * PHP version 7
 */

$app['log.level'] = Monolog\Logger::ERROR;
/**
 * SQLite database file
 */
$app['db.options'] = array(
    'driver' => 'pdo_sqlite',
    'path' => realpath(ROOT_PATH . '/app.db'),
);
