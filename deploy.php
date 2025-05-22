<?php
namespace Deployer;

require 'recipe/symfony.php';

// Config

set('repository', 'https://github.com/artlek/shopping-list');
set('http_user', 'www-data');
set('keep_releases', 10);
set('writable_mode', 'chmod');
set('env', [
    'DATABASE_URL' => 'mysql://srv87156_shoppinglist:kochammajonez@127.0.0.1:3306/srv87156_shoppinglist?serverVersion=10.11.11-MariaDB-cll-lve&charset=utf8mb4',
]);

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('h60.seohost.pl')
    ->set('remote_user', 'srv87156')
    ->set('deploy_path', '~/shopping-list-api');

// Hooks

after('deploy:failed', 'deploy:unlock');