<?php
namespace Deployer;

require 'recipe/common.php';

// Config

set('application', 'docker_symfony_start');

set('keep_releases', 2);

set('git_tty', true);

set('repository', 'git@github.com:fico7489/docker_symfony_start.git');

host('develop')
    ->set('hostname', '206.81.29.148')
    ->set('deploy_path', '/home/docker_symfony_start/app')
    ->set('remote_user', 'docker_symfony_start')
    //->set('identity_file', '~/.ssh/id_rsa')
    ->set('forward_agent', true)
    ->set('ssh_multiplexing', false)
    ->set('ssh_arguments', ['-o UserKnownHostsFile=/dev/null', '-o StrictHostKeyChecking=no']);

task('deploy', [
    'deploy:setup',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'custom:vendor_install',
    'deploy:writable',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'custom:after_deploy',
    'deploy:cleanup',
    'deploy:success',
]);

$writableFolders = [
    'var/',
];

$writableFoldersPermission = '755';

task('custom:vendor_install', function () use ($writableFolders, $writableFoldersPermission) {
    //move to release patch
    cd('{{release_path}}');

    // set up writable folders
    foreach ($writableFolders as $writableFolder) {
        //run('chmod -R '.$writableFoldersPermission.' '.$writableFolder.';');
    }

    run('docker compose exec -w "/var/www/releases/{{release_name}}" php composer install --optimize-autoloader --no-dev;');

    //TODO migrate, opcache and other
});

task('custom:after_deploy', function () {
    cd('{{release_path}}');
    run('docker compose restart php');
});


